<template>
    <div>

        <label>Select image: </label>
        <label for="img" class="btn btn-default bg-green"><i class="far fa-plus-square">

        </i></label>


        <input
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
                    <img v-if="input.id" :src="input.id" class="rounded mx-auto d-block"
                         style="max-height: 100%;">
                </div>
            </div>
        </div>
        <div>
            <button @click="formSubmit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
    },

    data() {
        return {
            inputs: [],
            test: 1,
            data: null,
            photoarr: [],
            photo: null,
        };
    },

    methods: {
        onFileChange(e) {


            //Save the img file to the array that were actually are going to upload
            this.photoarr.push(e.target.files[0]);

            //Add the file to the input arr which is used to display images
            const file = e.target.files[0];
            this.inputs.push({
                id: URL.createObjectURL(file),
                name: file.name
            });

            //console.log("ONCHANGE: ", this.inputs);
        },

        remove(index) {
            //When image deleted remove it from both the display array & upload array
            this.inputs.splice(index, 1);
            this.photoarr.splice(index, 1);
        },


        formSubmit(event) {
            //prevent triggering controller
            event.preventDefault();

            //create form data which through send images
            const data = new FormData();
            //Add each image to an array
            this.photoarr.forEach((p)=>{
                data.append('photo[]', p);
            });

            //post images to controller with axios
            axios.post("/admin/banner", data)
                .then(res => {
                    //console.log(res.data);
                }).catch(err => {
                console.log(err)});





        },
    }

}
</script>
