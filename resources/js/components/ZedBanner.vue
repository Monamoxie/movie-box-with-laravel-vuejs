<template>
    <div class="jumbotron" :style="bottomBannerBackgroundImage ? bottomBannerBackgroundImage : ''">
            <div class="overlay">
                <div class="container">
                    <h1 class="display-4">Hello, world!</h1>
                    <p class="lead">
                        In a land of myth, and a time of magic, the destiny of a great kingdom rests on the shoulders of a young boy. His name....
                        Merlin.
                    </p>
                    <hr class="my-4">
                    <p> A quote from the drama series Merlin </p>
                    <a class="btn btn-primary btn-lg" href="javascript:void(0)" role="button">Learn more</a>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    name: 'ZedBanner',
    data() {
        return {
            bottomBannerBackgroundImage: 'background-image: url("' + require('../../images/banner22.jpg') + '")'
        }
    }
}
</script>