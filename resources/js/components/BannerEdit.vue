<template>
    <div>
        <label>Select image: </label>
        <label for="img" class="btn btn-default bg-green"><i class="far fa-plus-square">

        </i></label>


        <input required
               type="file"
               id="img"
               name="img[]"
               accept="image/*"
               @change="onFileChange"
               multiple
               style="display: none"/>


        <div class="row w-100">


            <div v-for="(input, index) in inputs" class="row center w-100 m-2">
                <div class="carousel slide w-100 d-flex flex-wrap align-items-center"
                     v-model="input.id"
                     style="
                        background-color: black;
                        height: 30vh;">
                    <button type="button"
                            @click="remove(index)"
                            style="position: absolute;
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

            for (let i = 0; i < e.target.files.length; i++) {
                const file = e.target.files[i];

                this.inputs.push({
                    id: URL.createObjectURL(file),
                    name: file.name
                });
            }


            document.getElementById("img").files = null;
            document.getElementById("img").value = null;

            let arr = [];
            for (let i = 0; i < this.inputs.length; i++) {
                const blobToFile = this.inputs[i];
                blobToFile.lastModifiedDate = new Date();
                blobToFile.name = this.inputs[i].name;
                arr[i] = blobToFile;


            }
            console.log(this.inputs);


            //for(let i = 0;i<this.inputs.length;i++){
            //  console.log(this.inputs);}


        },
        remove(index) {

            this.inputs.splice(index, 1);


        },
    }

}
</script>
