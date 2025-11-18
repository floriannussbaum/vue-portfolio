<template>
  <div class="contact">
    <div>
      <p>
        <span>Schön, von Dir zu hören.</span>
        <span>Wenn Du Fragen hast oder einfach nur Hallo sagen möchten, setz Dich gern mit mir in Verbindung und kontaktiere mich.</span>
      </p>
    </div>
    <div>
      <form method="post" autocomplete="off" action="/">

        <div class="stacks" ref="someHeight">
          <div v-for="(tag, index) in form"
            :key="index"
            class="stack"
            ref="someActive"
          >
            <div class="label" ref="someName"
              :class="crumbs(index)"
              :style="slide(index)"
              @click="switshCrumb(index)"
            >
              <i :class="tag.icon" />
                <label :class="[isVisible ? 'typed' : '']" :for="tag.name">{{ tag.label }}</label>
            </div>
            <i :class="tag.icon" />
            <input :type="tag.type" :name="tag.name" ref="someFocus" maxlength="100" tabindex="-1" @keydown="setCheckTimer()" v-model="tag.value" v-if="tag.tag == 'input'">
            <textarea :name="tag.name" ref="someFocus" maxlength="800" tabindex="-1" @keydown="textareaRow($event.target), setCheckTimer()" v-model="tag.value" v-else-if="tag.tag == 'textarea'"></textarea>
          </div>
          <div class="messageLeange" v-if="form[sequence].tag == 'textarea'">{{ messageLeange() }}</div>
        </div>

        <div class="submit">
          <input type="submit" value="Next" ref="nextButton" :class="[unlockNextButton(true) ? 'enabled' : '']" @click="nextSequence($event)">
          <div class="magicButton">
            <span class="sendProgress" ref="sendProgress" />
            <input type="submit" value="Submit your message" ref="sendButton" :class="[unlockSendButton(true) ? 'enabled' : '']" @click="sendMail($event)">
          </div>
        </div>
      </form>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      isSendProgress: false,
      form: [
        { tag: 'input',
          type: 'text',
          name: 'name',
          validated: RegExp('^(?! )( ?[a-zA-Z]+[a-zA-ZäöüÄÖÜß]{2}){1,3}$'),
          validatedInfo: 'Benutzen Sie bitte eine richtige email Adresse!',
          defaultLabel: 'Fill with your name',
          label: 'Fill with your name',
          value: '',
          crumbsWidth: 0,
          icon: 'icon-person',
        },
        { tag: 'input',
          type: 'text',
          name: 'email',
          validated: RegExp( '^'+
            '(?![.])([.]?[a-zA-Z0-9äöüÄÖÜß!\'#$%&*+\/=?^_`{|}~-]){1,64}'+ // localPage
            '@'+
            '(?![.])([\.\-]?[a-zA-Z0-9äöüÄÖÜß]){1,252}[.][a-zA-Z]{2,24}'+ // domainPart
            '$' ),
          defaultLabel: 'Now your email address',
          label: 'Now your email address',
          value: '',
          crumbsWidth: 0,
          icon: 'icon-email',
        },
        { tag: 'textarea',
          name: 'message',
          validated: RegExp('^[a-zA-Z0-9äöüÄÖÜß!\'#$%&*+\/=?^_`{|}~ ,\.\n-]{1,800}$'),
          defaultLabel: 'Now write your awesome message',
          label: 'Now write your awesome message',
          value: '',
          crumbsWidth: 0,
          icon: 'icon-write',
        },
      ],
      sequence: 0,
      loopCounter: 0,
      hasChecket: 0,
      tapTimer: null,
      tapTimer_is_on: false,
      isVisible: false,
    };
  },
  watch: {
    sequence(newVal, oldVal) {
      this.$refs.someFocus[newVal].focus();
      
      // if( oldVal == (this.form.length -1) && this.form[oldVal].value ) { // last crumb save
      //   // this.form[oldVal].label = this.form[oldVal].value;
      //   this.labelAnimation(oldVal);
      // }

      // if( this.form[oldVal].label != this.form[oldVal].defaultLabel ) { // no empty label and after label set
      //   // if( !this.form[oldVal].value ) { // save no check value
      //     this.form[oldVal].value = this.form[oldVal].label;
      //   // }
      // }

      if( !this.isSendProgress ) {
        if( this.form[oldVal].tag == 'textarea' && this.form[oldVal].value ) { // last crumb save
          this.hasChecket++;
        }
        this.valueAnimation(oldVal, newVal);
      } else {
        this.$refs.someHeight.style.height = '50px';
        this.removeClass(this.$refs.someActive[oldVal], "active");
        this.addClass(this.$refs.someActive[newVal], "active");
        this.isSendProgress = false;
      }
    },
  },
  methods: {
    messageLeange() {
      let elementValue = this.form[this.sequence].value;
      let limit = 800;
      let leange = limit - elementValue.length;

      if( leange < 0 ) {
        this.form[this.sequence].value = elementValue.substring(0, limit);
        return 0;
      }
      return leange;
    },
    valueAnimation(oldIndex, newIndex) {
      let oldElement = this.form[oldIndex];
      let newElement = this.form[newIndex];

      let oldValue = this.form[oldIndex].value.trim();
      let oldLabel = this.form[oldIndex].label;
      let newValue = this.form[newIndex].value;

      let oldLength = oldValue.split("").length;
      let newLength = newElement.label.split("").length;

      let labelLength = oldElement.label.split("").length;
      let maxLength = Math.max(labelLength, oldLength);

      this.valueLoopOld(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength);
    },
    labelLoop(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength) {
      if( this.loopCounter != maxLength && this.hasChecket ) {
        let LabelSlpit = oldElement.label.split("");
        let valueSplit = oldValue.split("");

        if( this.loopCounter < valueSplit.length ) { // exchange string
          LabelSlpit[this.loopCounter] = valueSplit[this.loopCounter];
          oldElement.label = LabelSlpit.join("");
        } else { // delete string overflow
          oldElement.label = oldElement.label.slice (0, -1);
        }
        
        this.loopCounter++;
        setTimeout(() =>
          this.labelLoop(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength)
        , 20);
      } else {
        // set input focus
        this.removeClass(this.$refs.someActive[oldIndex], "active");
        this.addClass(this.$refs.someActive[newIndex], "active");
        // switch back to normal color
        this.$refs.someFocus[oldIndex].style.color = '#a2abb7';

        if( !oldValue ) { // no value exist set label to default
          oldElement.label = oldElement.defaultLabel;
        } else if( !newValue ) { // no next value exist
          newElement.label = "";
        }

        // reset values because 1 string ignored
        newElement.value = "";
        oldElement.value = oldValue;

        // no label and value exist set back
        if( !oldValue && oldLabel != oldElement.defaultLabel ) {
          oldElement.label = oldLabel;
          oldElement.value = oldLabel;
        }

        // set value back when no checked
        if( !this.hasChecket && oldLabel == oldElement.defaultLabel ) {
          oldElement.value = '';
        }

        this.loopCounter = 0;
        this.hasChecket = 0;
        this.valueLoopNew(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength);
      }
    },
    valueLoopOld(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength) {
      if( this.loopCounter != (oldLength -1) && oldValue ) { // value slice to 1 && value exist
        oldElement.value = oldElement.value.slice (0, -1);

        if( this.isTextareaRow(oldElement, oldValue, (oldLength -2)) ) { // activate when new row
          this.textareaRow( this.$refs.someFocus[oldIndex] ); // set textarea rows
        }

        this.loopCounter++;
        setTimeout(() =>
          this.valueLoopOld(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength)
        , 20);
      } else {
        this.$refs.someFocus[oldIndex].style.color = 'transparent';

        this.loopCounter = 0;
        this.labelLoop(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength);
      }
    },
    valueLoopNew(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength) {
      if( this.loopCounter != newLength ) {

        if( !newValue ) { // no value exist
          newElement.label = newElement.label + newElement.defaultLabel.split("")[this.loopCounter];
        } else {
          newElement.value = newElement.value + newElement.label.split("")[this.loopCounter];

          if( this.isTextareaRow(newElement, newElement.label, (newLength -1)) ) { // activate when new row
            this.textareaRow( this.$refs.someFocus[newIndex] ); // set textarea rows
          }
        }

        this.loopCounter++;
        setTimeout(() =>
          this.valueLoopNew(oldIndex, oldElement, oldLabel, oldValue, oldLength, newIndex, newElement, newValue, newLength, maxLength)
        , 20);
      } else {
        this.loopCounter = 0;
      }
    },
    isTextareaRow(textareaElement, textareaText, length) {
      if( textareaElement.tag == 'textarea' ) {
        if( textareaText.split("")[this.loopCounter] == "\n" || length == this.loopCounter ) {
          return true;
        }
      }
      return false;
    },
    textareaRow(event) {
      let eventOffsetParent = this.$refs.someHeight;
      let rows = event.value.length ? event.value.split(/\r\n|\r|\n/).length : 0;

      setTimeout(function() {
        event.style.height = 'auto';
        if( rows <= 1 ) {
          eventOffsetParent.style.height = '50px';
        } else {
          event.style.height = event.scrollHeight + 'px';
          eventOffsetParent.style.height = event.scrollHeight + 'px';
        }
      },0);
    },
    slide(index) {
      if( this.form[index].value ) {
        let margin = 8;
        let width = 0;
        for (let x=0; x <= index; x++) {
          if( x != 0 ) {
            width = width + this.$refs.someName[(x - 1)].offsetWidth;
            this.form[x].crumbsWidth = width + (x * margin);
          }
        }
        return { transform: 'translateY(-50px) scale(.8) translateX('+ this.form[index].crumbsWidth +'px)' };
      }
    },
    crumbs(index) {
      if( this.form[index].value ) {
        return 'crumbs';
      }
    },
    nextSequence(event) {
      event.preventDefault();

      if( this.loopCounter == 0 ) {
        if( this.unlockNextButton() ) {
          this.hasChecket++;
          this.sequence++;
        } else {
          this.timeoutClass(this.$refs.someActive[this.sequence], "erro", 2100)
        }
      }
    },
    sendMail(event) {
      event.preventDefault();

      if( this.loopCounter == 0 && !this.isSendProgress ) {
        if( this.unlockSendButton() ) {
          this.isSendProgress = true;

          // set status progress to wait
          let sendButton = this.$refs.sendButton;
          let sendProgress = this.$refs.sendProgress;
          sendButton.value = 'wait for it ..';
          sendButton.style.width = '189px';
          sendButton.style.borderBottom = '0px';
          sendProgress.style.width = '90%';

          // create data stack for axios
          var mailPackage = new Object();
          for( let x=0; x < this.form.length; x++ ) {
            let name = this.form[x].name;
            mailPackage[name] = this.form[x].value;
          }

          axios.post('http://fn-code.com/sendmail.php', mailPackage)
          .then( response => {
            if( response.data ) {
              let alert = response.data;
              // set status progress to success
              this.formStatus(sendButton, sendProgress, alert.message, alert.status);
            } else {
              // set status progress to error
              this.formStatus(sendButton, sendProgress, "error!", alert.status);
            }
          })
          .catch( error => {
            // set status progress to error
            this.formStatus(sendButton, sendProgress, "connection problem", alert.status);
          });
        }
      }
    },
    formStatus(sendButton, sendProgress, message, status) {
      let self = this;

      // status set to success or erro
      setTimeout(function() {
        sendButton.value = message;
        sendProgress.style.width = '100%';
        sendProgress.style.transitionDuration = '0s';

        let alertInfo;
        if( status === true ) {
          alertInfo = "success";
        } else {
          alertInfo = "erro";
        }
        for( let x=0; x < self.$refs.someActive.length; x++ ) {
          self.timeoutClass(self.$refs.someActive[x], alertInfo, 2100)
        }
      }, 1400);

      // mail Button set to default
      setTimeout(function() {
        sendButton.value = 'Submit your message';
        sendButton.style.borderBottom = '3px solid #797979';
        sendProgress.style.width = '0%';
        setTimeout(() =>
          sendProgress.style.transitionDuration = '2s'
        , 200);
        if( status === true ) {
          self.formReset();
          setTimeout(() =>
            self.sequence = 0
          , (self.form.length * 500));
        } else {
          self.form[self.sequence].label = self.form[self.sequence].value;
          self.sequence = 0;
        }
      }, 3100);
    },
    formReset() {
      for (let x=(this.form.length -1); x >= 0; x--) {
        let element = this.form[x];
        let self = this;
        setTimeout(function() {
          self.timeoutClass(self.$refs.someName[x], "slideOut", (x * 2000));
          setTimeout(function() {
            element.value = '';
            element.label = element.defaultLabel;
          }, (x * 500));
        }, ((self.form.length * 500) - (x * 500)));
      }
    },
    switshCrumb(index) {
      if( this.form[index].value && this.loopCounter == 0 ) {
        this.sequence = index;
      }
    },
    addClass(element, name) {
      return element.classList.add(name);
    },
    removeClass(element, name) {
      return element.classList.remove(name);
    },
    toggleClass(element, name) {
      return element.classList.toggle(name);
    },
    timeoutClass(element, name, time) {
      this.addClass(element, name);
      setTimeout(() =>
        this.removeClass(element, name)
      , time);
    },
    unlockNextButton(delay) {
      if( this.sequence < (this.form.length -1) ) { // all before last Crumb check

        if( delay ) { // check delay
          return this.getTimerDelay(this.$refs.nextButton);
        }
        return this.checkFormValidated();
      }
      return false;
    },
    unlockSendButton(delay) {
      if( (this.form.length -1) == this.sequence ) { // only last Crumb check

        if( delay ) { // check delay
          return this.getTimerDelay(this.$refs.sendButton);
        }
        return this.checkFormValidated();
      }
      return false;
    },
    checkFormValidated() {
      if( this.loopCounter == 0 ) {
        return ( this.form[this.sequence].value.match(this.form[this.sequence].validated) );
      }
      return false;
    },
    getTimerDelay(element) {
      if( this.tapTimer_is_on ) { // is tapTimer run then check old status from button
        if( element.classList == 'enabled' ) {
          return true;
        }
        return false;
      }
      return this.checkFormValidated();
    },
    setCheckTimer() {
      this.tapTimer_is_on = true;
      let self = this;
      clearTimeout(this.tapTimer);
      this.tapTimer = setTimeout(function () {
        self.tapTimer_is_on = false;
      }, 200);
    },
    onScroll() {
      let Element = this.$el;
      let ElementTop = Element.offsetTop;
      let WindowHeight = window.innerHeight / 2;

      if( window.pageYOffset > ElementTop - WindowHeight && !this.isVisible ) {
        this.isVisible = true;
      }
    },
  },
  mounted() {
    this.addClass(this.$refs.someActive[0], "active");

    window.addEventListener("scroll", this.onScroll);
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  },
};
</script>

<style lang="scss">
.contact {
  :focus {
    outline: none;
  }

  .stacks {
    position: relative;
    margin: 100px 0 15px 0;
    height: 50px;
    font-weight: 700;
    font-size: 18px;

    .stack {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      border-bottom: 1px solid #a2abb7;
      background-color: #48525e;
      cursor: pointer;

      @media only screen and (min-width: 415px) {
        width: 80%;
      }

      &.active {
        z-index: 120;
      }

      &.erro {
        animation: Erro 2s ease;

        .label, i, input, textarea {
          animation: Erro 2s ease;
        }

        @keyframes Erro {
          50% {
            color: #c60202;
            border-color: #c60202;
          }
        }
      }

      &.success {
        animation: Success 2s ease;

        .label, i, input, textarea {
          animation: Success 2s ease;
        }

        @keyframes Success {
          50% {
            color: #009688;
            border-color: #009688;
          }
        }
      }

      i {
        position: absolute;
        left: 10px;
        top: 0;
        height: 100%;
        display: flex;
        align-items: center;
        max-height: 50px;
        font-size: 24px;
      }
      
      .label {
        position: relative;
        display: inline-block;
        padding: 16px 40px;
        line-height: 1rem;
        transform-origin: 0 50% 0;
        transition: transform .1s ease-out,background .2s ease-out,padding .1s ease-out,left 0s;
        left: 0;

        &.slideOut {
          transition: opacity .4s ease-out,left .9s ease-out;
          opacity: 0;
          left: 100vw;
        }

        label {
          cursor: pointer;
          display: inline-block;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
          max-width: 300px;
          width: 0; // typed animation
          font-size: 1rem;

          @media only screen and (min-width: 455px) {
            font-size: 1.12rem;
          }

          &.typed {
            animation: typing .4s 0s steps(30, end) forwards;

            @keyframes typing {
              0% { width: 0; text-overflow: unset }
              99% { width: 100%; text-overflow: unset }
              100% { width: 100%; text-overflow: ellipsis }
            }
          }
        }

        &.crumbs {
          line-height: 36px;
          height: 36px;
          background: #3a3a3a;
          padding: 0px 5px 0px 40px;
        }
      }

      input, textarea {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        font-family: 'Roboto', Arial, sans-serif;
        font-weight: 700;
        color: #a2abb7;
        border: none;
        line-height: 100%;
        padding: 0 40px;
        background-color: transparent;
        width: 80%;
        font-size: 1rem;

        @media only screen and (min-width: 455px) {
          font-size: 1.12rem;
        }

        @media only screen and (min-width: 415px) {
          width: 100%;
        }
      }
      textarea {
        height: 70%;
        resize: none;
        padding: 15px 40px 0px;
        overflow: hidden;
      }
    }

    .messageLeange {
      font-weight: 500;
      font-size: 1.1rem;
      position: absolute;
      top: 106%;
      right: 0;
      z-index: 130;

      @media only screen and (min-width: 415px) {
        width: 27%;
      }
    }
  }

  .submit {
    display: flex;

    input[type=submit], input[type=button] {
      background: #9e9e9e;
      color: #c4c4c4;
      padding: 8px 16px;
      margin-right: 0.5rem;
      border-radius: 3px;
      border: none;
      border-bottom: 3px solid #797979;
      box-shadow: 0 5px 0px -2px #2f2f2f;
      cursor: pointer;
      font-size: .8rem;
      line-height: 24px;
      font-weight: 700;
      text-transform: uppercase;

      &.enabled {
        background: #009688;
        color: #ebf1f8;
      }

      &.disabled {
        background: #c60202;
        color: #ebf1f8;
      }
    }

    :last-of-type input {
      margin-right: 0;
    }

    .magicButton {
      position: relative;
    
      .sendProgress {
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background-color: rgba(0,0,0,.2);
        transition-property: width;
        transition-duration: 2s;
        transition-timing-function: linear;
      }
    }
  }
}
</style>
