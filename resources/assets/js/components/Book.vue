<div class="">
    <ul class="list-inline" style="margin-right:2em">
        <li class='book' style="margin-right:2em">
            <img :src="image" @click="showModal = true" />
        </li>
    </ul>
</div>

<script>
  export default {
      mounted(){
        console.log('dduuuud');
      },
      props: [
          'image',
          'title'
      ],

  }
</script>
