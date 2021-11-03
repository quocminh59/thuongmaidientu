<template>
	<div>
		<breadcrumb :links="links"></breadcrumb>
		<div class="title">Thêm danh mục laptop</div>
		<notification :type="message.type" :content="message.content" :show="display"></notification>
		<div v-if="loading">
			<div class="waiting">
				<img :src="base + '/images/loading.gif'" alt="">
			</div>
		</div>
		<div v-else>
				<simplebar data-simplebar-auto-hide="true" class="laptop-create">
			<form @submit.prevent="update()" >
				<div class="row">
					<simplebar data-simplebar-auto-hide="true" class="area-left col-sm-6">
						<div class="row mb-4">
							<label for="name" class="col-sm-3 col-form-label">Tên sản phẩm</label>
							<div class="col-sm-9">
								<input type="text" v-model="product.name" id="name" class="form-control para">
							</div>
							<label class="col-sm-3"></label>
                    		<strong class="col-sm-9" v-if="isEmpty(errors.name)" v-show="show">{{ errors.name[0] }}</strong>
						</div>

						<div class="row mb-4 ">
							<label for="brand_id" class="col-sm-3 col-form-label">Hãng sản xuất</label>
							<div class="col-sm-9">
								<select v-model="product.brand_id" id="brand_id" class="form-select para">
									<option
										v-for="(item,index) in list_brands" 
										:key="'brand'+index"
										:value="item.id"
									>
										{{ item.brand_name }}
									</option>
								</select>
							</div>
							<label class="col-sm-3"></label>
                    		<strong class="col-sm-9" v-if="isEmpty(errors.brand_id)" v-show="show">{{ errors.brand_id[0] }}</strong>
						</div>
						
						<div class="row mb-4">
							<label for="quantity" class="col-sm-3 col-form-label">Số lượng</label>
							<div class="col-sm-9">
								<input type="text" v-model="product.quantity" id="quantity" class="form-control para">
							</div>
							<label class="col-sm-3"></label>
                    		<strong class="col-sm-9" v-if="isEmpty(errors.quantity)" v-show="show">{{ errors.quantity[0] }}</strong>
						</div>

						<div class="row mb-4">
							<label for="price" class="col-sm-3 col-form-label">Giá sản phẩm</label>
							<div class="col-sm-9">
								<input type="text" v-model="product.price" id="price" class="form-control para">
							</div>
							<label class="col-sm-3"></label>
                    		<strong class="col-sm-9" v-if="isEmpty(errors.price)" v-show="show">{{ errors.price[0] }}</strong>
						</div>

						<div class="row mb-4">
							<label for="percent" class="col-sm-3 col-form-label">Giảm giá(%)</label>
							<div class="col-sm-9">
								<input type="text" v-model="product.sales_percent" id="percent" class="form-control para">
							</div>
							<label class="col-sm-3"></label>
                    		<strong class="col-sm-9" v-if="isEmpty(errors.sales_percent)" v-show="show">{{ errors.sales_percent[0]}}</strong>
						</div>

						<div class="row mb-4">
							<label for="feature-image" class="col-sm-3 col-form-label">Ảnh đại diện</label>
							<div class="col-sm-9">
								<input type="text"  id="feature-image" class="form-control para">	
								<input type="button" name="btn-upload" value="Chọn tệp" id="btn-upload" class="btn-upload" @click="uploadImage()">
							</div>
							<label class="col-sm-3"></label>
                    		<strong class="col-sm-9" v-if="isEmpty(errors.feature_image)" v-show="show">{{ errors.feature_image[0] }}</strong>	
						</div>

						<div class="row mb-4">
							<label for="sub-image" class="col-sm-3 col-form-label">Ảnh chi tiết</label>
							<div class="col-sm-9">
								<input type="text"  id="sub-image" class="form-control para">
								<simplebar data-simplebar-auto-hide="true" class="show-subimage" v-if="arrayMultiImage.length > 0">
									<div class="wrap-img">
										<span 
											v-for="(path, index) in arrayMultiImage"
											:key="'img'+index"
										>
											<img :src="base + path" alt="">
											<i class="fal fa-times-circle" @click="removeItem(arrayMultiImage, path)"></i>
											
										</span>			
									</div>
								</simplebar>	
								<input type="button" name="btn-multi-upload" value="Chọn đa tệp" id="btn-multi-upload" class="btn-upload" @click="multiUploadImage()"> 
							</div>
						</div>

						<div class="row mb-4">
							<label for="product-tag" class="col-sm-3 col-form-label">Tag sản phẩm</label>
							<div class="col-sm-9">
								<input-tag id="product-tag" :tagPassed="tagPassed" :directive="directive" @passing="product.tag = $event" class="form-control para"></input-tag>
							</div>
						</div>		
					</simplebar>

					<simplebar class="area-right col-sm-6" data-simplebar-auto-hide="true">
						<div class="row mb-4">
							<label for="product-type" class="col-sm-4 col-form-label">Chủng loại</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.type" id="product-type" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="part-number" class="col-sm-4 col-form-label">Part Number</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.partnumber" id="part-number" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="product-color" class="col-sm-4 col-form-label">Màu sắc</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.color" id="product-color" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="cpu" class="col-sm-4 col-form-label">Bộ vi xử lý</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.cpu" id="cpu" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="chipset" class="col-sm-4 col-form-label">Chipset</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.chipset" id="chipset" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="ram" class="col-sm-4 col-form-label">Bộ nhớ trong</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.ram" id="ram" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="number-of-ram" class="col-sm-4 col-form-label">Số khe cắm</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.numberofram" id="number-of-ram" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="max-ram" class="col-sm-4 col-form-label">Dung lượng tối đa</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.maxram" id="max-ram" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="vga" class="col-sm-4 col-form-label">VGA</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.vga" id="vga" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="hard-disk" class="col-sm-4 col-form-label">Ổ cứng</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.harddirk" id="hard-disk" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="drive" class="col-sm-4 col-form-label">Ổ quang</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.drive" id="drive" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="card-reader" class="col-sm-4 col-form-label">Card Reader</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.cardreader" id="card-reader" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="security" class="col-sm-4 col-form-label">Bảo mật, Công nghệ</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.security" id="security" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="monitor" class="col-sm-4 col-form-label">Màn hình</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.monitor" id="monitor" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="webcam" class="col-sm-4 col-form-label">Webcam</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.webcam" id="webcam" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="audio" class="col-sm-4 col-form-label">Audio</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.audio" id="audio" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="network" class="col-sm-4 col-form-label">Giao tiếp mạng</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.network" id="network" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="wifi" class="col-sm-4 col-form-label">Giao tiếp không dây</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.wifi" id="wifi" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="hub" class="col-sm-4 col-form-label">Cổng giao tiếp</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.hub" id="hub" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="battery" class="col-sm-4 col-form-label">Pin</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.pin" id="battery" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="size" class="col-sm-4 col-form-label">Kích thước</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.size" id="size" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="weight" class="col-sm-4 col-form-label">Cân nặng</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.weight" id="weight" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="operating-system" class="col-sm-4 col-form-label">Hệ điều hành</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.operating" id="operating-system" class="form-control para">
							</div>
						</div>

						<div class="row mb-4">
							<label for="spare" class="col-sm-4 col-form-label">Phụ kiện đi kèm</label>
							<div class="col-sm-8">
								<input type="text" v-model="product.para.spare" id="spare" class="form-control para">
							</div>
						</div>
					</simplebar>
				</div>

				<div class="row mb-4">
					<label for="parent-id" class="col-sm-12 col-form-label">Chọn danh mục ( nhấn Ctrl để chọn đa danh mục )</label>
					<div class="col-sm-12">
						<select multiple class="form-control" id="parent-id" v-model="product_category">
							<option value="1" v-show="false"></option>
							<option
								v-for="(item,index) in list_categories"
								:key="'cate'+index" 
								:value="item.category_id"
							>
								{{ item.category_name }}
							</option>
						</select>
					</div>
				</div>

				<div class="row mb-4">
					<label for="content-laptop" class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
					<div class="col-sm-12">
						<textarea id="content-laptop" name="content-laptop"></textarea>
					</div>	
				</div>

				<div class="row mb-4">
					<label for="gift-laptop" class="col-sm-2 col-form-label">Nội dung quà tặng</label>
					<div class="col-sm-12">
						<textarea  id="gift-laptop" name="gift-laptop"></textarea>
					</div>	
				</div>

				<div class="row mt-10">
                    <div class="col-sm-10">
                        <input type="submit"  @click="changeDisplay()" class="btn btn-success add" value="Thêm sản phẩm">
                    </div>
                </div>
			</form>
		</simplebar>
		</div>
	</div>
</template>

<script>
import base from './../../../baseurl';
import {selectFileWithCKFinder,selectMultiFileWithCKFinder} from './../../../function';

export default {
	components: {},
	data() {
		return {
			links: ["Home", "Product Management", "Laptop", "Create"],
			loading: true,
			message: {},
			arrayMultiImage:[],
			arrayImage:[],
			product: {
				tag: [],
				category: [1],
				para: {},
				content:null,
				gift: null,
			},
			list_categories: null,
			list_brands: null,
			errors:{},
            show: true,
			display:null,
			directive: 'pass',
            tagPassed: [],
            product_category: [],
			base: base,
		};
	},
  	methods: {
		uploadImage() {
        	selectFileWithCKFinder( 'feature-image', this.arrayImage);	
	  	},
		multiUploadImage() {		
        	selectMultiFileWithCKFinder( 'sub-image', this.arrayMultiImage );
			this.sub_image = this.arrayMultiImage;
		},
		displayCKEDITOR(object) {
			CKEDITOR.replace(object, {
				filebrowserBrowseUrl: base + "/ckfinder/browser?CKEditor=text&CKEditorFuncNum=3&langCode=vi",
			});
		},
		getValueCKEDITOR(object) {
			return CKEDITOR.instances[object].getData();
		},
        passValueCKEDITOR(object,content) {
            return CKEDITOR.instances[object].setData(content);
        },
		resetValueCKEDITOR(object) {
			return CKEDITOR.instances[object].setData('');
		},
		passValueInput(object, value) {
			document.getElementById(object).value = value;
		},
		removeItem(array, value) {
			for(let i = 0; i < array.length; i++) {
				if(array[i] == value) {
					array.splice(i, 1);
					this.passValueInput('sub-image', this.arrayMultiImage);
				}	
			}
		},
		update() {
			this.product.content = this.getValueCKEDITOR('content-laptop');
			this.product.gift = this.getValueCKEDITOR('gift-laptop');
			this.product.feature_image = this.arrayImage;
			this.product.subimage = this.arrayMultiImage;
			axios.post(`${base}/admin/product/update/${this.$route.params.id}`, this.product);
		},
        getDataForm() {
            axios.get(`${base}/admin/product/showtags/${this.$route.params.id}`)
            .then((response) => {
                for(let i = 0; i < response.data.length; i++) {
                    this.tagPassed.push(response.data[i].tag_name);
                }
            });
            axios.get(`${base}/admin/product/showcategories/${this.$route.params.id}`)
            .then((response) => {
                for(let i = 0; i < response.data.length; i++) {
                    this.product_category.push(response.data[i].category_id);
                }
                this.product.category = this.product_category;
            });
			axios.get(`${base}/admin/product/showsubimages/${this.$route.params.id}`)
			.then((response) => {
				for(let i = 0; i < response.data.length; i++) {
                    this.arrayMultiImage.push(response.data[i].image_path);
                }
				this.passValueInput('sub-image', this.arrayMultiImage);
			});
			axios.get(`${base}/admin/product/show/${this.$route.params.id}`)
			.then((response) => {
				this.product = response.data;
				this.product.sales_percent = response.data.sales_percent * 100;
				this.product.para = JSON.parse(response.data.specifications);
				this.arrayImage.push(response.data.feature_image);
				this.passValueInput('feature-image', this.arrayImage);
				this.passValueCKEDITOR('content-laptop', this.product.content);
                this.passValueCKEDITOR('gift-laptop', this.product.gift);
			});
		},
		isEmpty: function(a = new Array()) {
            if(a.length == 0) {
                return false;
            }
            return true;
        },
		changeDisplay: function() {
			setTimeout(()=> {
				this.display = false;			
				this.message = {};	
			},2000);
        },

  	},
	mounted() {
		setTimeout(()=> {
			this.displayCKEDITOR('content-laptop');
			this.displayCKEDITOR('gift-laptop');
		},3000);	
	},
	created () {
		
		axios.get(`${base}/admin/brand`).then((response)=> {
			this.list_brands = response.data;
		});
		axios.get(`${base}/admin/category/recursive`).then((response)=> {
			this.list_categories = response.data;
		});
		
		setTimeout(()=> {
			this.loading = false;
			this.getDataForm();
		},3000);
		
		
	},

};
</script>

<style>
.laptop-create {
    position: fixed;
    width: 78%;
    height: 69%;
    top: 20rem;
    left: 20.5%;
    border: 1px solid;
    border-radius: 6px;
    padding: 3rem 3rem;
    color: white;
    font-size: 1.6rem;
}

.laptop-create input,select {
	width: 70%;
	height: 3.5rem;
	border-radius: 5px;
	font-size: 1.5rem;
}

.laptop-create label {
	color: #6ab1d69e;
	font-weight: bold;
}

.add {
	font-size: 1.5rem;
	width: 15% !important;
}

strong {
	color: red;
}

.btn-upload {
	width: 8rem !important;
	height: 3rem !important;
	background: #c9c6c6;
	margin-top: 1rem;
	border: none;
}

#btn-upload, #btn-multi-upload {
	font-size:1.4rem;
}

.area-right, .area-left {
    width: 100%;
    height: 42rem;
    border: 2px solid gray;
    position: relative;
    border-radius: 6px;
	padding-top:3rem;
}

.area-left::after {
	content: "Thông tin cơ bản";
	position: absolute;
    top: -2rem;
    font-size: 1.5rem;
    font-weight: bold;
    background: blue;
    border-radius: 3px;
    padding: 1rem;
    width: 16rem;
    text-align: center;
}

.area-right::after {
	content: "Thông số kỹ thuật";
	position: absolute;
    top: -2rem;
    font-size: 1.5rem;
    font-weight: bold;
    background: #ff0000fa;
    border-radius: 3px;
    padding: 1rem;
    width: 16rem;
    text-align: center;
}

.para {
	width: 95%!important;
	font-size:1.5!important;
}

#parent-id {
	font-size:1.5rem!important;
	height:40rem!important;
}

#sub-image-carousel {
	margin-top: 2rem;
}

.show-subimage {
	max-width: 100%;
	height: 7rem;
}

.wrap-img {
	display:flex;
	flex-wrap: wrap;
}

.wrap-img img {
        width: 6rem;
    height: 6rem;
    display: block;
    float: left;
    margin-right: 1rem;
    margin-top: 1rem;
    border: 1px solid white;
}

.wrap-img span i {
    position: absolute;
    right: 5px;
    top: 3px;
    color: red;
    background: #222526;
    border-radius: 10px;
    cursor: pointer;
}

.wrap-img span {
    position: relative;
}

.waiting img {
    width: 15rem;
    height: 15rem;
}
.waiting {
    width: 100%;
    height: 73rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
