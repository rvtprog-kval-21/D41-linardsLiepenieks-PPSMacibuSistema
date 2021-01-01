<template>
    <div>
        <label for="img">Select image:</label>
        <input type="file" id="img" name="img" accept="image/*" @change="onFileChange">


        <div class="row w-100">


            <div v-for="(input, index) in inputs" class="row center w-100 m-2">
                <div class="carousel slide w-100 d-flex flex-wrap align-items-center"  v-model="input.id"
                     style="background-color: black; height: 30vh;" >
                    <button @click="remove(index)" style="position: absolute;
                                   background: red;
                                   color: white;
                                   top: -10px;
                                   right: -10px;">
                        X
                    </button>
                    <img v-if="input.id" :src="input.id" class="rounded mx-auto d-block">
                </div>

            </div>
        </div>

    </div>
</template>
<script>
export default {
    mounted() {
    },

    data() {
        return {
            inputs: []
        };
    },

    methods: {
        onFileChange(e) {

            const file = e.target.files[0];
            console.log(URL.createObjectURL(file));
            this.inputs.push({
                id: URL.createObjectURL(file)
            });


        },
        remove(index) {
            this.inputs.splice(index, 1);

        },
    }

}
</script>
