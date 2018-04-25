<template lang="html">
  <div class="">
    <div class="row container mt-5">
      <div class="col-md-2 ">
        <img :src="book.volumeInfo.imageLinks.thumbnail" class="img-responsive" alt="">
      </div>

      <div class="col-md-8 col-sm-12 ">
        <h1 class="site__title site__title--separator">
            {{ book.volumeInfo.title }}
        </h1>
        <label for="" class="site__label"> {{book.volumeInfo.authors[0]}}, {{ publishedDate }}</label>
        <p v-html="book.volumeInfo.description"></p>
      </div>

      <div class="col-md-2">
        <button type="button"
                style="display: flex;justify-content: center;width:100%;height:55px;background:red;color:#fff"
                name="button"
                @mouseover="toggleRemove = true"
                v-show="gid && toggleRemove"
                @mouseleave="toggleRemove = false"
                @click="removeFromReadingList()"
        >
            remove
        </button>
        <button type="button"
                style="display: flex;justify-content: center;width:100%;height:55px;background:green;color:#fff"
                name="button"
                @click="saveToReadingList()"
                v-show="!saving && !gid"
        >
            Save
        </button>

        <button type="button"
                style="display: flex;justify-content: center;width:100%;height:55px;background:green;color:#fff"
                name="button"
                @mouseover="toggleRemove = true"
                @mouseleave="toggleRemove = false"
                v-show="gid && !saving && !toggleRemove"
        >
            Saved To List
        </button>
      </div>
    </div>

  </div>
</template>


<script>
  export default {
      mounted(){
        console.log('dduuuud');
      },
      data() {
          return {
              saving: false,
              toggleRemove: false,
          }
      },
      props: [
          'book',
          'gid'
      ],
      computed: {
          requestData() {
              return  {
                  google_id: this.book.id,
                  title: this.book.volumeInfo.title,
                  author: this.book.volumeInfo.authors[0],
                  description: this.book.volumeInfo.description,
                  image: this.book.volumeInfo.imageLinks.thumbnail,
                  slug: this.slug,
                  page_count: this.book.volumeInfo.pageCount
              };
          },
          publishedDate() {
              return new Date( this.book.volumeInfo.publishedDate).getFullYear();
          },
          slug() {
              return this.book.volumeInfo.title.split(' ').join('-')
          }
      },
      methods: {
          toggleModal() {
              this.$emit('toggle-book-details', this.id);
          },
          saveToReadingList() {
              this.saving = true;
              this.axios.post('/books', this.requestData).then((response) => {
                  this.saving = false;
                  this.gid = response.data.id
              }, this)
          },
          removeFromReadingList() {
              this.saving = true;
              this.axios.delete('/reading-list/' + this.gid).then((response) => {
                  this.saving = false;
                  this.gid = false;
              }, this)
          },
      }
  }
</script>
