<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">My Reading List</h1>

      <div class="btn-toolbar mb-2 mb-md-0">

        <button class="btn btn-sm btn-outline-secondary " @click="sortBooksList()">
          Sort By Author
          <img :src="sortIcon" height="15px" alt="">

        </button>

        <div class="btn-group ml-2" v-show="orderChanged">
            <button class="btn btn-sm btn-outline-success" @click="saveOrderChanges(this.books)">Save Current Order</button>
        </div>

      </div>

    </div>
        <draggable :list="this.books"  :options="{animation:100}" class="row" @change="imageDragged()">
            <div v-for="book in books"  :key="book.id" track-by="">
                <a class="col-md-2" :href="'/google-books/' + book.google_id ">
                  <span class="badge badge-info" style="position:absolute;top:0">{{ book.order }}</span>
                    <img :src="book.image" height="200px" class="img-responsive mb-5 " alt="Card image cap">
                </a>
            </div>
        </draggable>
    </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Draggable from 'vuedraggable';

Vue.use(VueAxios, axios);

    export default {
        components: {
            Draggable
        },
        mounted() {
          this.fetchBooks('order','ASC');
        },
        data() {
          return {
            sortBy: 'order',
            orderBy: 'ASC',
            books: null,
            orderChanged:false
          }
        },
        computed: {
            orderKey() {
                if ( this.orderBy == 'DESC') {
                    return 'ASC';
                }
                if ( this.orderBy == 'ASC') {
                    return  'DESC';
                }
            },
            sortIcon() {
                if ( this.sortBy == 'last_name' && this.orderBy == 'DESC') {
                    return "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/MediaWiki_Vector_skin_action_arrow.svg/2000px-MediaWiki_Vector_skin_action_arrow.svg.png";
                }
                if ( this.sortBy == 'last_name' && this.orderBy== 'ASC') {
                    return 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/76/MediaWiki_Vector_skin_up_arrow.svg/2000px-MediaWiki_Vector_skin_up_arrow.svg.png';
                }
            },
            requestData() {
                return this.books.map(
                    function(book) {
                        return {
                            'id': book.id,
                            'order': book.order
                        };
                    }
                );
            }
        },
        methods: {
            imageDragged() {
                this.orderChanged = true;
                this.updateOrder();
            },
            fetchBooks(sortBy, orderBy) {
                this.axios.get('books?sort=' + sortBy + '&order=' + orderBy).then((response) => {
                    this.books = response.data;
                })
            },
            googleUrl(google_id) {
                return "https://books.google.com/books?id=" + google_id;
            },
            sortBooksList() {
                this.sortBy = 'last_name';
                this.orderBy = this.orderKey;

                this.updateOrder();

                return this.fetchBooks(this.sortBy, this.orderBy);
            },
            updateOrder() {
                this.books.map((book, index) => {
                    book.order = index + 1;
                })
                console.log('done');
            },
            saveOrderChanges() {
                this.axios.put('reorder-list/',  this.requestData).then((response) => {
                    this.orderChanged = false;
                }, this)
            }
        },
    }
</script>
