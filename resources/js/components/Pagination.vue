<template>
      <nav aria-label="Page navigation" >
        <ul class="pagination text-center">
            <li class="page-item" v-if="paginationParam.prev_page_url !== null">
                <span class="page-link"  @click="$router.push({ name: 'moviesPaged', params: { page: this.paginationParam.current_page - 1 }  })">Previous</span>
            </li>

            <li class="page-item" v-for="(prev, key) in prevPages" :key="'prev' + key">
                <a class="page-link" :href="`/movies/${ prev }`">{{ prev }}</a>
            </li> 
            <li v-if="dotter !== ''" class="page-item">
                <span class="page-link">{{ dotter }}</span>
            </li> 
                
            <li class="page-item" v-for="(next, index) in nextPages" :key="'next' + index">
                <a class="page-link" :href="`/movies/${ next }`">{{ next }}</a>
            </li> 

            <li class="page-item" v-if="paginationParam.next_page_url !== null">
                <span class="page-link"  @click="$router.push({ name: 'moviesPaged', params: { page: this.paginationParam.current_page + 1 }  })">Next</span>
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    name: 'Pagination',
    data() {
        return { 
            prevPages: [],
            dotter: '',
            nextPages: []
        }
    },
    props: {
        paginationParam: {
            type: Object, 
            required: true
        }
    }
}
</script>