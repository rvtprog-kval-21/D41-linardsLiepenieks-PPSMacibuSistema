<template>
    <div class="p-3">
        <!-- Header -->

            <!-- Title -->
            <div class="row m-0 PPS-page-title">
                <div class="box-title align-self-center ml-3" style="font-size: 25px;">Pievienot Tagu</div>
                <div @click="addTest">
                    <button type="button" class="btn PPS-add-button">
                        <i class="far fa-plus-square"></i>
                    </button>
                </div>
            </div>

            <!-- Addtest button-->


        <div class="row PPS-content-header mb-3">
            <table class="table table-bordered ">
                <!-- Info tags -->
                <tr>
                    <th style="width: 7%" class="text-center">#</th>
                    <th style="width: 40%">Nosaukums</th>
                    <th style="width: 40%">Apraksts</th>
                    <th style="width: 13%">Krāsa</th>
                </tr>

                <!-- Dynamically added tags -->
                <tr v-for="(input, index) in inputs" class="form-group text-center"
                v-bind:bgcolor="input.color?input.color:'#F4F6F9'">

                    <!-- Tag id/ remove button -->
                    <th style="width: 5%" class="text-center"
                        v-model="input.id">
                        {{index+1}}
                        <!-- Remove tag button -->
                        <div @click="removeTest(index, input)">
                            <button type="button" class="btn PPS-delete-button"><i
                                class="far fa-minus-square"></i></button>
                        </div>
                    </th>

                    <!-- Nosaukums input -->
                    <th >
                        <textarea class=" PPS-content-footer w-100 form-control "
                                  v-model="input.name"
                                  maxlength="64"
                                  style="width: 100%; height: 100%; box-sizing: border-box;
                    ">
                        </textarea>

                    </th>
                    <!-- Apraksts input -->
                    <th>
                        <textarea class="w-100 form-control"
                                  v-model ="input.desc"
                                  style="width: 100%; height: 100%; box-sizing: border-box;">
                        </textarea>

                    </th>
                    <th class="align-middle">
                        <input type="color"
                               v-model="input.color"
                               />
                    </th>


                </tr>
            </table>
        </div>

        <div>
            <button @click="formSubmit" type="submit" class="btn PPS-info-button">Saglabāt izmaiņas</button>
        </div>
    </div>
</template>

<script>
export default {

    props:['oldTags'],

    mounted() {

        this.oldTags.forEach(
            element=>this.inputs.push({
                type: "old",
                name: element.name,
                desc: element.desc,
                color: element.color
            }))


    },


    data() {
        return {
            inputs: [],
            delete: [],
            newTags: [],
            updateTags:[],
        };
    },

    methods: {


        addTest() {

            this.inputs.push({

                type: "new",
                color: "#F4F6F9",
                desc: ""
            });
        },
        removeTest(index, input) {
            //console.log(input.type)
            if(input.type == "old")
            {
                this.delete.push(input);
            }
            this.inputs.splice(index, 1);





        },

        formSubmit(event) {
            //prevent triggering controller
            event.preventDefault();


            this.newTags = this.inputs.filter(function(e) {
                return e.type !== "old";
            });
            this.updateTags = this.inputs.filter(function(e) {
                return e.type === "old";
            });

            axios.post("/admin/tags", {
                newTags: this.newTags,
                delete: this.delete,
                update: this.updateTags,
            })
                .then(res => {
                    //console.log(res.data);
                    alert("Izmaiņas saglabātas");
                }).catch(err => {
                alert("Radusies kļūda");
                console.log(err)});

            location.reload();

        },
    }
}
</script>
