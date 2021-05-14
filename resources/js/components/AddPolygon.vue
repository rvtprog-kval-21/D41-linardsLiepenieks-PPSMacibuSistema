<template>
    <div class="container">
        <div class="row justify-content-start align-items-center">
            <h3 style="color: black;">Pievienot ar polygon</h3>
            <input style="background-color:lightgrey" type="file" class="m-2" @change="extract">
        </div>
    </div>
</template>

<script>
import JSZip from 'jszip'

export default {

    methods:
        {


            extract(event) {
                const file = event.target.files[0];

                this.setData(file, "statement-sections/latvian/name.tex", "kods");
                this.setData(file, "statement-sections/latvian/name.tex", "nosaukums");
                this.setData(file, "statement-sections/latvian/input.tex", "ievaddati");
                this.setData(file, "statement-sections/latvian/output.tex", "izvaddati");
                this.setData(file, "statement-sections/latvian/legend.tex", "definicija");

                let res = this.extractTests(file);
                res = res.then(function (r, root = this.$root) {

                    r.sort(function (a, b) {
                        var nameA = a.name.toUpperCase();
                        var nameB = b.name.toUpperCase();
                        if (nameA < nameB) {
                            return -1;
                        }
                        if (nameA > nameB) {
                            return 1;
                        }
                        return 0;
                    });

                    let see = 3;
                    for(let i = 0;i<r.length;i = i+2)
                    {
                        let data = {
                            stdin: r[i].data,
                            stdout: r[i+1].data,
                            show: 0,
                        }
                        if(see>0)
                        {data.show = 1;}
                        root.$emit('send-test', data);
                        see = see -1;
                    }
                }.bind(this))

                //console.log(res);


                /*r.sort(function(a, b) {
                    var nameA = a.name.toUpperCase(); // ignore upper and lowercase
                    var nameB = b.name.toUpperCase(); // ignore upper and lowercase
                    console.log(a.name);
                    if (nameA < nameB) {
                        return -1;
                    }
                    if (nameA > nameB) {
                        return 1;
                    }

                    // names must be equal

                    return 0;});*/

                //console.log(this.polygon);


                //this.$root.$emit('send-test', data);


            },

            setData(file, path, elementId) {
                let zip = new JSZip();
                let ret = zip.loadAsync(file).then(function (zip) {
                    return zip.file(path).async("text");
                })
                ret.then(function (result) {
                    document.getElementById(elementId).value = result;

                })


            },

            async extractTests(file) {
                let Zip = new JSZip();
                let tests =
                    await Zip.loadAsync(file).then(
                        (zip) => {
                            const promises = [];
                            zip.folder("tests")
                                .forEach(function (relativePath, file) {
                                        promises.push(
                                            zip.file("tests/" + relativePath)
                                                .async("text")
                                                .then((data) => {
                                                    return {name: relativePath, data: data}
                                                }))
                                    }
                                );
                            return promises;
                        })
                return Promise.all(tests);
            }
        }
}
</script>
