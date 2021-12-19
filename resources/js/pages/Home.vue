<!--
-- Home page component
-->

<template>
  <!-- <div> -->
    <!-- rendre le nom reactive -->
    <Header
      title="Your Daily Assistant"
      subtitle="Faciliter la vie avec notre conciergerie"
    />

    <!-- <div> -->
      <!-- Catalogue card -->
      <!-- <div class="row-md-4">
        <div class="col d-flex justify-content-middle">
          <div class="row-sm">
            <h5 class="headers">Catalogue</h5>
            <br />
            Une grande séléction de produits et services, par nos soins, pour
            vos membres
          </div>
          <div class="row-sm">
            <h5 class="headers">Entreprises</h5>
            <br />
            Possibilité de gérer vos membres connectés et les offres qu'ils
            puissent accéder
          </div>
          <br />
          <div class="row-sm">
            <h5 class="headers">Statistiques</h5>
            <br />
            Suivez vos consommations afin d'assurer un retour sur investissement
          </div>
        </div>
      </div>
      <figure class="text-end mt-5">
        <blockquote class="blockquote">
          <p>
            Un service au top, toujours avec le sourire et professionalisme.
          </p>
        </blockquote>
        <figcaption class="blockquote-footer">
          Guillaume Louge de <cite title="Source Title">Le Bocal Academy</cite>
        </figcaption>
      </figure>
    </div>
  </div> -->
</template>

<script>
import Header from "../components/ui/Header.vue";
import OrderDisplay from "../components/ui/orders/OrderDisplay.vue";

export default {
  name: "Home",
  components: {
    Header,
    OrderDisplay,
  },
};
</script>

<style scoped>
.headers {
  color: #e78c15;
}
</style>
