<template>
    <div class="p-3">
        <div v-for="user in users" class="row PPS-content-wrapper text-center" style="font-size: 25px; align-items: center;">
            <div class="col" v-model="user.name">{{user.name}}</div>
            <div class="col">{{user.email}}</div>
            <div class="col-2 row">
                <div class="col"><input :value="user.admin"
                                        true-value="1"
                                        false-value="0"
                                        type="checkbox" @click="changeAdmin($event)"></div>
                <label for="checkbox" class="col">{{user.admin==0? 'Nav': 'Ir'}}</label>


            </div>

            <div class="col-2">WIP</div>
            <button class="col-1 PPS-delete-button" ><i class="fas fa-trash"></i></button>
        </div>

    </div>

</template>

<script>
export default {

    props:['users'],

    mounted() {
    console.log(this.users);
    },


    data() {
        return {
        };
    },

    methods: {
        changeAdmin(event){
            console.log(event.target.model);

        }
    }
}
</script>
