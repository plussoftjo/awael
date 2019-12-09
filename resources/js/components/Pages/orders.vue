<template>
  <div>
    
    <v-toolbar flat color="black">
      <v-toolbar-title>Orders</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-card>
          <v-card-title color="blue" class="pb-0 mb-0">
            <span class="headline">معلومات الطلب</span>
          </v-card-title>
            <v-container grid-list-md justify-center align-item style="text-align:right;">
              <v-layout row wrap>
              	<v-flex xs12>
              		<div style="font-weight: 500; font-size: 16px;">
              			الاسم : <span style="font-size: 14px;">{{editedItem.name}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			رقم الهاتف : <span style="font-size: 14px;">{{editedItem.phone}}</span>
              		</div>
                  <div style="font-weight: 500; font-size: 16px;">
              			رقم الموبايل : <span style="font-size: 14px;">{{editedItem.mobile}}</span>
              		</div>
                  <div style="font-weight: 500; font-size: 16px;">
              			البريد الالكتروني  : <span style="font-size: 14px;">{{editedItem.email}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			العنوان : <span style="font-size: 14px;">{{editedItem.address}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			المدينة : <span style="font-size: 14px;">{{editedItem.name}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			ZIP CODE : <span style="font-size: 14px;">{{editedItem.post}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			صورة البطاقة الشخصية : 
              			<v-img :src="editedItem.image" width="150px" height="150px"></v-img>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			صورة الوثيقة : 
              			<v-img :src="editedItem.imageI" width="150px" height="150px"></v-img>
              		</div>
              	</v-flex>
              </v-layout>
            </v-container>
        </v-card>
        <v-card>
          <v-card-title color="blue" class="pb-0 mb-0">
            <span class="headline">معلومات العامل</span>
          </v-card-title>
            <v-container grid-list-md justify-center align-item style="text-align:right;">
              <v-layout row wrap>
              	<v-flex xs12>
              		<div style="font-weight: 500; font-size: 16px;">
              		  الرقم التعريفي : <span style="font-size: 14px;">{{editedItem.cv.id}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			الاسم : <span style="font-size: 14px;">{{editedItem.cv.name}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			refCode : <span style="font-size: 14px;">{{editedItem.cv.refcode}}</span>
              		</div>
              		<div style="font-weight: 500; font-size: 16px;">
              			الصورة : 
              			<v-img :src="editedItem.cv.image" width="150px" height="150px"></v-img>
              		</div>
              	</v-flex>
              </v-layout>
            </v-container>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">اغلاق</v-btn>
            <v-btn color="blue darken-1" flat @click="save">تأكيد العملية</v-btn>
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
        <td class="text-xs-center">{{ props.item.phone }}</td>
        <td class="text-xs-center">{{ props.item.created_at }}</td>
        <td class="text-xs-center">
			<span class="green--text" v-if="props.item.status">تم انجاز الطلب</span>
			<span class="red--text" v-else>لم يتم انجازه بعد</span>
        </td>
        <td class="justify-center layout px-0">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
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
      headers: [
        {
          text: '#',
          align: 'center',
          sortable: true,
          value: 'id'
        },
        { text: 'الاسم', value: 'name',sortable: false,align: 'center', },
        { text: 'رقم الهاتف', value: 'phone',sortable: false,align: 'center', },
        { text: 'تاريح الطلب', value: 'phone',sortable: false,align: 'center', },
        { text: 'حالة الطلب', value: 'status',sortable: false,align: 'center', },
        { text: 'متابعة الطلب', value: 'Index',sortable: false,align: 'center', },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
       cv:{}
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
        axios.get('admin/orders/index').then(response => {
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
      	const vm = this;
        axios.get('admin/orders/done/' + vm.editedItem.id).then(response => {
        	location.reload();
        }).catch(err => {
        	console.log(err)
        });
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