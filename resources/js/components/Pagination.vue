<template>
      <nav aria-label="Page navigation" >
        <ul class="pagination text-center">
            <li class="page-item" v-if="paginationParam.prev_page_url !== null">
                <span class="page-link"  @click=" this.$router.push({ name: 'moviesPaged', params: { page: this.paginationParam.current_page - 1 }  })">Previous</span>
            </li>

            <li class="page-item" v-for="(prev, key) in prevPages" :key="'prev' + key">
                <span class="page-link"  @click=" this.$router.push({ name: 'moviesPaged', params: { page: prev }  })">{{ prev }}</span>
            </li> 
            <li v-if="dotter !== ''" class="page-item">
                <span class="page-link">{{ dotter }}</span>
            </li> 
                
            <li class="page-item" v-for="(next, index) in nextPages" :key="'next' + index">
               <span class="page-link"  @click=" this.$router.push({ name: 'moviesPaged', params: { page: next }  })">{{ next }}</span>
            </li> 

            <li class="page-item" v-if="paginationParam.next_page_url !== null">
                <span class="page-link"  @click=" this.$router.push({ name: 'moviesPaged', params: { page: this.paginationParam.current_page + 1 }  })">Next</span>
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
    },
       mounted() {
        
        if(Object.keys(this.paginationParam).length > 0) {

            // run previous pager
            if(this.paginationParam.current_page !== 1) { 
                const endPoint = this.paginationParam.current_page <= 3 ? 1 : this.paginationParam.current_page - 3
               
                for (let i = this.paginationParam.current_page - 1; i >= endPoint; i--) {
                    this.prevPages.push(i);
                }
                (this.prevPages.length > 1) ? this.prevPages.reverse() : this.prevPages
            }

            // run dotter 
            const pagesExpected = this.paginationParam.total / this.paginationParam.per_page
            if(this.paginationParam.current_page < pagesExpected - 3) {
                this.dotter = '...'
            }

            // run previous pager
            if(this.paginationParam.current_page !== this.paginationParam.last_page) {
                const endPoint = this.paginationParam.current_page + 3 <= this.paginationParam.last_page ? this.paginationParam.current_page + 3 : paginationParam.last_page
                for (let i = this.paginationParam.current_page + 1; i <= endPoint; i++) {
                    this.nextPages.push(i);
                }
            } 

        } 
        
    },
}
</script>