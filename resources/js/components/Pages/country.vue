<template>
  <div>
    <v-toolbar flat color="black">
      <v-toolbar-title>الجنسيات</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">اضافة جنسية جديدة</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 >
                  <v-text-field v-model="editedItem.title" label="العنوان"></v-text-field>
                </v-flex>
                <v-flex xs12 v-if="editedItem.image">
                  <v-img :src="editedItem.image" hegiht="100px" width="auto"></v-img>
                </v-flex>
                <v-flex xs12>
                  <label for="image">قم باختيار صورة</label>
                	<input type="file" placeholder="اختيار صورة " v-on:change="onFileChange">
                </v-flex>
                <v-flex xs12 v-if="error">
                  <p style="color:red;font-weight:700;">يوجد خطا في الحقول الرجاء التاكد</p>
                </v-flex>
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
        <td class="text-xs-center">{{ props.item.title }}</td>
        <td class="justify-center layout px-0">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="deleteItem(props.item)"
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
          value: 'name'
        },
        { text: 'العنوان', value: 'title',sortable: false,align: 'center', },
        { text: 'تعديل/حذف', value: 'edit',sortable: false,align: 'center', },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        title: '',
       	image:null
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
        axios.get('admin/country/index').then(response => {
          vm.desserts = response.data;
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
        axios.get('admin/country/destroy/' + item.id).then(response => {
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
          axios.post('admin/country/update',vm.editedItem).then(response => {
            Object.assign(vm.desserts[vm.editedIndex], vm.editedItem);
             this.close()
          }).catch(err => {
            console.log(err)
            vm.error = true;

          });
          
        } else {
          const vm = this;
          vm.error = false;
          axios.post('admin/country/store',this.editedItem).then(response => {
            this.desserts.push(response.data);
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