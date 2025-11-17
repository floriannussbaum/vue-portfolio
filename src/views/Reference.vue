<template>
  <div class="reference">
    <TheHeader />
    <TheMenu />

    <section id="explanation" class="wapper-page">
      <div class="container-page">
        <header>
          <h2>Referenz</h2>
        </header>
        <article>
          <div class="reference">
            <h3>Einleitung</h3>
            <p>
              <span>
                In diesem Bereich möchte ich auf das Portfolio selbst als Projekt eingehen.
                Ich möchte einen Teil meines Wissensstands veranschaulichen, damit Du es einfacher hast, mich einzuschätzen.
              </span>
              <span>
                Um einen kleinen Eindruck von meinen Design- und Animationsfähigkeiten zu erhalten, hielt ich es für ein tolles side project, ein Portfolio in Vue.js umzusetzen.
              </span>
            </p>

            <h3>Einblick über GitHub</h3>
            <p class="explanation-alert">
              <i class="icon-info" />
              <span>
                Es handelt sich um eine alte Codebase, welche mit Vue 2 entwickelt wurde. Dieses Portfolio dient <strong>nicht</strong> zur Veranschaulichung der aktuellen Code Quallität.
              </span>
            </p>
            <div class="explanation-link">
              <i class="icon-github" /> <a href="https://github.com/floriannussbaum/vue-portfolio" title="Code" target="_blank">github.com/floriannussbaum/vue-portfolio</a>
            </div>
          </div>
        </article>
      </div>
    </section>

  </div>
</template>

<script>
import TheHeader from "@/components/TheHeader";
import TheMenu from '@/components/TheMenu';

export default {
  name: "Reference",
  components: {
    TheHeader,
    TheMenu,
  },
  metaInfo: {
    title: 'Referenz – Webdesign & Development',
  },
};
</script>

<style lang="scss" scoped>
#explanation {
  .explanation-link {
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
  
      i {
        color: var(--font-dark);
        margin-right: 4px;
    }
  }
  
  .explanation-alert {
    display: flex;
    background: gray;
    padding: 8px 12px;
    color: white;
    border-radius: 4px;
      
    i {
      margin-right: 12px;
    }
  
    span {
      margin: 0;
    }
  }
}
</style>
