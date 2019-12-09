<template>
  <div>
    <v-toolbar flat color="black">
      <v-toolbar-title>العمالة</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">عامل جديد</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <!-- CV  -->
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.name" reverse label="الاسم الكامل"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-select 
                  :items="countrys"
                  item-text="title"
                  item-value="title"
                  v-model="editedItem.natonalty"
                  label="الجنسية"></v-select>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.refcode" label="Ref No."></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-select
                  :items="genders"
                  v-model="editedItem.gender"
                  label="الجنس"></v-select>
                </v-flex>
                <v-flex xs12 >
                  <v-select
                  :items="status"
                  label="الحالة الاجتماعيه"
                  v-model="editedItem.status"></v-select>
                </v-flex>
                <v-flex xs12 >
                  <v-select
                  :items="sections"
                  label="القسم"
                  item-text="title"
                  item-value="title"
                  v-model="editedItem.section"></v-select>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.note" label="ملاحظات"></v-text-field>
                </v-flex>
                <v-flex xs12 v-if="editedItem.image">
                  <v-img :src="editedItem.image" hegiht="100px" width="auto"></v-img>
                </v-flex>
                <v-flex xs12>
                	<input type="file" placeholder="Pickup Image" v-on:change="onFileChange">
                </v-flex>

                <!-- END OF CV  -->

                <!-- Profile -->
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.religion" label="الديانة"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.height" label="الطول"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.weight" label="الوزن"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.payment" label="الراتب الشهري"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.loop" label="مدة العقد"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.passportnumber" label="رقم الجواز"></v-text-field>
                </v-flex>
                <!-- END PROFILE -->
  
                <!-- Application Details  -->
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.address" label="العنوان"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.birthday" label="تاريخ الميلاد"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.birthplace" label="مكان الولادة"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.child" label="عدد الاطفال"></v-text-field>
                </v-flex>

                <!-- Application Details End  -->

                <!-- learn -->
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.arabic" label="اللغة العربية"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.english" label="اللغة الانجليزية"></v-text-field>
                </v-flex>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.education" label="التعليم"></v-text-field>
                </v-flex>

                <!-- End Of Learning -->

                <!-- lastJob -->
                <v-card>
                  <v-card-title class="white">
                    <div class="font-weight-black black--text">
                      الوظائف السابقة
                    </div>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="() => {editedItem.lastJobs.push({})}">+</v-btn>
                  </v-card-title>
                  <v-flex xs12 v-for="(lj,index) in editedItem.lastJobs" :key="index">
                    <v-layout row wrap>
                     <v-flex xs4 >
                        <v-text-field v-model="lj.country" label="الدولة"></v-text-field>
                      </v-flex>
                      <v-flex xs4 >
                        <v-text-field v-model="lj.position" label="الوظيفة"></v-text-field>
                      </v-flex>
                      <v-flex xs4 >
                        <v-text-field v-model="lj.period" label="المدة"></v-text-field>
                      </v-flex> 
                    </v-layout>
                  </v-flex>
                </v-card>
                

                <!-- End Last Job -->

                
                <!-- skills -->
                 <v-card style="width:100%;">
                  <v-card-title class="white">
                    <div class="font-weight-black black--text">
                      المهارات
                    </div>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="() => {editedItem.skills.push({})}">+</v-btn>
                  </v-card-title>
                  <v-flex xs12 v-for="(sk,index) in editedItem.skills" :key="index">
                    <v-layout row wrap>
                     <v-flex xs12 >
                      <v-text-field v-model="sk.title" label="المهارة"></v-text-field>
                    </v-flex> 
                    </v-layout>
                  </v-flex>
                </v-card>
                <!-- end skills -->


              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">الغاء</v-btn>
            <v-btn color="blue darken-1" flat @click="save">حفظ</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1 "
    >
      <template v-slot:items="props" >
        <td class="text-xs-center ">{{ props.item.id }}</td>
        <td class="text-xs-center">{{ props.item.name }}</td>
        <td class="justify-center layout px-0">
         <!--  <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon> -->
          <v-icon
            small
            @click="deleteItem(props.item)"
            color="red"
          >
            delete
          </v-icon>
        </td>
      </template>
    </v-data-table>
  </div>
</template>
<script>
  export default {
    data: () => ({
      dialog: false,
      error:false,
      headers: [
        {
          text: '#',
          align: 'center',
          sortable: false,
          value: 'id'
        },
        { text: 'الاسم', value: 'name',sortable: false,align: 'center', },
        { text: 'تعديل/حذف', value: 'edit',sortable: false,align: 'center', },
      ],
      desserts: [],
      countrys:[],
      genders:['ذكر','انثى'],
      status:['اعزب','متزوج'],
      sections:[],
      editedIndex: -1,
      editedItem: {
        title: '',
       	image:null,
        lastJobs:[{}],
        skills:[{}]
      },
      defaultItem: {
        title: '',
       	image:null
      }
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      }
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        const vm = this;
        axios.get('admin/cv/index').then(response => {
          // vm.desserts = response.data;
          vm.countrys = response.data.countrys;
          vm.sections = response.data.sections;
          vm.desserts = response.data.cvs;
        }).catch(err => {
          console.log(err)
        });
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?') && 
        axios.get('admin/cv/destroy/' + item.id).then(response => {
          this.desserts.splice(index, 1)
        }).catch(err => {
          console.log(err)
        });
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          const vm = this;
          vm.error = false;
          axios.post('admin/mainSection/update',vm.editedItem).then(response => {
            Object.assign(vm.desserts[vm.editedIndex], vm.editedItem);
            this.close()
          }).catch(err => {
            console.log(err)
            vm.error = true;
          });
          
        } else {
          const vm = this;
          vm.error = false;
          axios.post('admin/cv/store',this.editedItem).then(response => {
          	location.reload();
            this.close()
          }).catch(err => {
            console.log(err)
            vm.error = true;
          });
        }
      },
      onFileChange(e) {
	    let files = e.target.files || e.dataTransfer.files;
	     if (!files.length)
	        return;
	    this.createImage(files[0]);
	    },
	    createImage(file) {
	     let reader = new FileReader();
	      let vm = this;
	      reader.onload = (e) => {
	          vm.editedItem.image = e.target.result;
	      };
	      reader.readAsDataURL(file);
	   }
    }
  }
</script>