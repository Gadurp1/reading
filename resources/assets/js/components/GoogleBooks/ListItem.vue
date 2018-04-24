<template lang="html">
  <div class="">
    <div class="col-md-2">
        <a :href="'/google-books/' + google_id ">
          <img :src="image" height="200px" class="img-responsive mb-5" alt="Card image cap">
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
          'google_id',
          'description'

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
