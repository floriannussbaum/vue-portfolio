<template>
  <div class="home">
    <TheHeader />
    <TheMenu />

    <div class="wapper-page">
      <section id="about" class="container-page">
        <article class="my">
          <div class="info gap">
            <h2>Über mich</h2>
            <p>
              <span>
                Mein Name ist Florian Nußbaum.
              </span>
              <span>
                Ich bin Frondend Webentwickler aus Leidenschaft im Leipziger Raum.
              </span>
              <span>
                Zuletzt habe ich mich mit dem Aufbau generischer UI Komponenten und der Entwicklung von Apps sowie progressiver Webapplikationen beschäftigt.
              </span>
              <span>
                Hauptsächlich arbeitete ich mit Vue.js in Kombination aus Nuxt.js und Tailwind CSS, da sich mit diesen Tools moderne Webseiten effizient und performant umsetzen lassen.
              </span>
              <span>
                Meine Kernkompetenzen liegen in der Teamarbeit und Kommunikation, semantischem Coding und im Allgemeinen das Produkt als Ganzes im Blick zu behalten.
              </span>
            </p>
          </div>

          <Picture class="spacing" :src="'Florian_Glaeser.jpg'" :alt="'Ein Porträt von Florian Nußbaum'" :title="'Portree von Florian Nußbaum'" />
        </article>

        <article>
          <div class="balancing gap">
            <h2>Mein Ausgleich</h2>
            <p>
              <span>
                In meiner Freizeit bin ich sportlich sehr aktiv und betreibe Parkour/Freerunning, was mir die Möglichkeit bietet,
                meinen Ausgleich zu finden.
              </span>
              <span>
                Im Zuge dessen betreue ich seit 2013 verschiedene Projekte und Prozesse für Kinder und Jugendliche,
                um ihnen einen sicheren Raum für den Sport zu bieten.
              </span>
            </p>
          </div>

          <Picture class="spacing" :src="'beam.jpg'" :alt="'Backflip Animation von Florian Nußbaum'" :title="'Backflip Animation Florian Nußbaum'" :animation='true' />

          <aside class="balancing">
            <h3>Verletzungsrisiko</h3>
              <p>
                <span>
                  Da in diesem Zusammenhang die Frage nach dem Verletzungsrisiko sehr häufig gestellt wird, möchte ich diese mit einem Unfallfreicounter beantworten.
                </span>
                <span>Unverletzt seit:</span>
              </p>
              <TheCounter :date="'2014-08-14'" />
          </aside>
        </article>
      </section>
    </div>

    <section id="skills" class="wapper-page">
      <div class="container-page">
        <header>
          <h2>Fähigkeiten</h2>
        </header>
        <article class="wrapper-skills">
          <div>
            <h3><p>Software</p><p>Development</p></h3>
            <ul>
              <li>Erfahrung in funktionaler und OOP Entwicklung</li>
              <li>JavaScript und TypeScript Programmierspche</li>
              <li>Entwicklungsalltag mit Bitbucket, Firebase, Docker, GitLab, GitHub, Jira/ Confluence und Scrum-Team</li>
            </ul>
          </div>

          <div class="line" :class="[isVisible ? 'active' : '']">
            <h3>Frontend</h3>
            <ul>
              <li>Leidenschaft für UI/UX</li>
              <li>Über 3 Jahre Entwicklungserfahrung in HTML, CSS, Tailwind CSS, Vue.js und Nuxt.js Frameworks</li>
              <li>Komplexe und performante Animationen</li>
            </ul>
          </div>

          <div>
            <h3>Mobile</h3>
            <ul>
              <li>Erfahrung in der Entwicklung progressiver Webapplikationen und plattformübergreifender Lösungen</li>
              <li>Verwendung des Ionic frameworks mit Android Studio und Xcode</li>
            </ul>
          </div>
        </article>
      </div>
    </section>

    <section id="work" class="wapper-page">
      <div class="container-page">
        <header>
          <h2>Referenz</h2>
        </header>
        <article>
          <div class="reference gap">
            <h3>Entstehung und Gedankengang des Portfolios</h3>
            <p>
              In diesem Bereich möchte ich auf das Portfolio selbst als Projekt eingehen.
              Ich möchte einen Teil meines Wissensstands veranschaulichen, damit Du es einfacher hast, mich einzuschätzen.
            </p>

            <router-link to="/reference/#explanation" title="Referenz">Mehr erfahren ...</router-link>
          </div>
        </article>
      </div>
    </section>

    <section id="contact">
      <header>
        <h2>Kontakt</h2>
      </header>
      <article>
        <TheContact class="spacing" />
      </article>
    </section>
  </div>
</template>

<script>
import TheHeader from "@/components/TheHeader";
import TheMenu from "@/components/TheMenu";
import TheCounter from '@/components/TheCounter';
import Picture from '@/components/Picture';
import TheContact from '@/components/TheContact';

export default {
  name: "Home",
  components: {
    TheHeader,
    TheMenu,
    TheCounter,
    Picture,
    TheContact,
  },
  metaInfo: {
    title: 'Webdesign & Development – Florian Nußbaum',
  },
  data() {
    return {
      isScrolled: false,
      windowTop: 0,
      isVisible: false,
    };
  },
  methods: {
    onScroll(e) {
      let Element = e.target.documentElement.getElementsByClassName('line')[0];
      let ElementTop = Element.offsetTop;
      let WindowHeight = window.innerHeight / 2;

      if( window.pageYOffset > ElementTop - WindowHeight && !this.isVisible ) {
        this.isVisible = true;
      }
    },
  },
  mounted() {
    window.addEventListener("scroll", this.onScroll);
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  },
};
</script>

<style lang="scss">
.wapper-page {
  display: flex;
  justify-content: center;
}

.container-page {
  display: inline-block;
  max-width: 1400px;
  width: 100%;
}

section {
  min-height: 80vh;

  header {
    text-align: center;
    padding-top: 6rem;
  }

  h2 {
    text-transform: uppercase;
    font-weight: 400;
    font-size: 32px;
    letter-spacing: 0.05em;
    margin-bottom: 1rem;
  }

  h3 {
    margin-bottom: 1rem;
    margin-top: 2rem;
    text-transform: uppercase;
    font-weight: 400;
    letter-spacing: 0.05em;
  }

  article {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    flex-wrap: wrap;
    padding: 5vh 1.25rem;

    @media only screen and (min-width: 1228px) {
      padding: 10vh 1.25rem;
    }

    @media only screen and (min-width: 850px) {
      .spacing {
        margin: 0 1rem;
      }
    }

    span {
      display: block;
      margin-bottom: 10px;
    }

    &:nth-of-type(2n) {
      flex-direction: row-reverse;
    }

    .info, .balancing, .reference {
      display: inline-block;
      width: 530px;
    }

    .balancing {
      .counter {
        margin-top: 2rem;
      }
    }

    .gap {
      margin: 0 1rem 4rem 1rem;
    }
  }

  &#contact, &#skills {
    color: var(--font-light);
    background-color: var(--bg-dark-blue);

    h2 {
      color: white;
    }
  }

  &#contact::before {
    content: "";
    display: inline-block;
    width: 100%;
    height: 4.6rem;
    background-color: white;
    clip-path: polygon(-1% 0%, 101% 0%, 50% 100%);
    position: relative;
    top: -1px;
  }

  &#work {
    align-items: center;

    a {
      color: var(--font-blue);
      display: inline-block;
      text-decoration: none;
      padding: 12px 10px 10px 0;

      &:hover {
        color: var(--font-dark);
        text-decoration: underline;
      }
    }
  }

  &#skills {
    align-items: center;

    .wrapper-skills {
      align-items: start;
      padding: 3rem 0;

      display: grid;
      grid-template-columns: repeat(1, minmax(auto, 100%));

      @media only screen and (min-width: 1000px) {
        grid-template-columns: repeat(3, minmax(33.3%, 33.3%));
      }

      div {
        letter-spacing: 0.05em;
        padding: 2rem 0;

        @media only screen and (min-width: 600px) {
          padding: 2rem 4rem;
        }

        @media only screen and (min-width: 1000px) {
          padding: 2rem 0;
        }

        h3 {
          text-align: center;
          margin-bottom: 2rem;
          margin-top: 0;
        }

        ul {
          padding: 0 4rem;
          list-style-type: none;

          li {
            margin-bottom: 1.3rem;
            position: relative;

            &::before {
              content: "";
              display: inline-block;
              width: 25px;
              height: 1px;
              margin-right: 10px;
              background-color: white;
              position: absolute;
              top: 50%;
              left: -35px;
            }
          }
        }

        &.line {
          position: relative;

          &.active {
            &::after, &::before {
              content: '';
              height: 1px;
              position: absolute;
              left: 5%;
              background-color: #ffffff33;
              animation: AnimationLineWidth 1.3s ease forwards;
            }

            &::before {
              top: 0;
            }
            &::after {
              bottom: 0;
            }

            @media only screen and (min-width: 1000px) {
              &::before {
                animation: AnimationLineHeight 1.3s ease forwards;
                background-color: var(--font-light);
                top: 0;
                left: 0;
                width: 1px;
              }
              &::after {
                animation: AnimationLineHeight 1.3s ease forwards;
                background-color: var(--font-light);
                top: 0;
                right: 0;
                left: unset;
                width: 1px;
              }  
            }

            @keyframes AnimationLineWidth {
              0% {
                width: 0%;
                opacity: 0;
              }
              50% {
                opacity: 1;
              }
              100% {
                width: 90%;
              }
            }

            @keyframes AnimationLineHeight {
              0% {
                height: 0%;
                opacity: 0;
              }
              50% {
                opacity: 1;
              }
              100% {
                height: 100%;
              }
            }
          }
        }
      }
    }
  }
}
</style>
