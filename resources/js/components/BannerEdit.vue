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
    props:['oldImages'],

    mounted() {
        //Add old images to upload and input array
        this.oldImages.forEach(
            element=>this.inputs.push({
                id: "../storage/" + element.file_path,
                type: "old"
            }))
        this.oldImages.forEach(
            element=>this.photoarr.push({
                id: "../storage/" + element.file_path,
                path: element.file_path,
                type: "old"
            }))
    },

    data() {
        return {
            inputs: [],
            photoarr: [],
            delete: [],
        };
    },

    methods: {
        onFileChange(e) {

            //Save the img file to the array that we are actually are going to upload
            this.photoarr.push(e.target.files[0]);
            console.log(this.photoarr);


            //Add the file to the input arr which is used to display images
            const file = e.target.files[0];
            this.inputs.push({
                id: URL.createObjectURL(file),
                name: file.name,
                type: "new"
            });
            //console.log("ONCHANGE: ", this.inputs);
        },

        remove(index) {
            //When image deleted remove it from both the display array & upload array

            if(this.photoarr[index].type == "old")
            {
                this.delete.push(this.photoarr[index].path);
            }
            this.inputs.splice(index, 1);
            this.photoarr.splice(index, 1);

        },


        formSubmit(event) {
            //prevent triggering controller
            event.preventDefault();
            //create form data which through send images
            console.log(this.delete);

            const data = new FormData();
            //Add each image to an array
            this.photoarr.forEach((p)=>{
                if(p.type != "old")
                data.append('photo[]', p);
            });

            this.delete.forEach((d)=>{
                data.append('delete[]', d);
            });

            //post images to controller with axios
            axios.post("/admin/banner", data)
                .then(res => {
                    //console.log(res.data);
                    alert("Izmaiņas saglabātas");
                }).catch(err => {
                console.log(err)});
        },
    }

}
</script>
