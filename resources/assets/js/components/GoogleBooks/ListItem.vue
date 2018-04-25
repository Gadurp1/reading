<template lang="html">
  <div class="">
    <div class="col-md-2">
      <a :href="'/google-books/' + google_id " v-show="image">
        <img :src="image" class="img-responsive mb-5 " :alt="title">
      </a>
    </div>
  </div>
</template>


<script>

  export default {
      name: 'list-item',
      props: [
          'image',
          'title',
          'google_id'
      ],
      computed: {
          saveData() {
            return  {
                google_id: this.book.id,
                model:"500",
                color:"white"
            };
          }
      },
  }
</script>
