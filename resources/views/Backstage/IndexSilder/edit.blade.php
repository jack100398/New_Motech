@extends('Backstage.layouts')
@section('content')
    <div id="app">
        @include('Backstage.component.title')
        <div class="row">
            <!-- Pie Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">輪播類型</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <select class="form-control" v-model="data.type">
                            <option value="1" selected>圖片</option>
                            <option value="2" selected>影片</option>
                        </select>
                    </div>
                </div>

                <div v-show="data.type === '2'" class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">影片連結</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <input type="text" v-model="data.url" class="form-control" placeholder="請輸入連結" aria-label="power"
                            aria-describedby="basic-addon1">
                    </div>
                </div>

                <div v-show="data.type === '1'" class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">圖片 (寬700*高422)</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <img id="demo-img" class="img-fluid" style="max-width: 50%;height:auto;" :src="data.url">
                        <input id="url" class="file" type="file" multiple data-min-file-count="1">
                        <button type="submit" class="btn btn-primary pull-right" v-on:click="upload('url')">上傳</button>
                    </div>
                </div>

                <div v-show="data.type === '1'" class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">連結</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <input type="text" v-model="data.link" class="form-control" placeholder="請輸入連結"
                            aria-label="power" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">是否顯示</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <input v-model="data.disabled" type="checkbox">
                        勾選以顯示
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-end">
            <button v-show="data.id > 0" type="button" class="btn btn-success" v-on:click="update">修改</button>
            <button v-show="data.id === 0" type="button" class="btn btn-primary" v-on:click="create">建立</button>
        </div>
    </div>
    <script src="{{ asset('Backstage/js/index_silder.js') }}"></script>
    <script>
        const {
            createApp
        } = Vue
        createApp({
            data() {
                return {
                    data: {
                        id: {{ $id }},
                        type: '1',
                        url: null,
                        disabled: 0,
                        link: null,
                    },
                }
            },
            mounted: async function() {
                if (this.data.id !== 0) {
                    await this.getItem();
                }
            },
            methods: {
                async upload(item) {
                    var url = await uploadImageWithSizeLimit(item, this.data[item]);
                    console.log(url);
                    this.data[item] = url ? url : this.data[item];
                },
                async getItem() {
                    await getItem(this.data.id)
                        .then(res => {
                            this.data = res;
                        })
                        .catch(err => {
                            alert('發生錯誤,請聯繫系統管理員');
                        })
                },
                async update(id) {
                    var data = this.data;
                    if (data.disabled == true) {
                        data.disabled = '啟用';
                    }
                    updateModel(data)
                },

                async create() {
                    var data = this.data;
                    if (data.disabled == true) {
                        data.disabled = '啟用';
                    }
                    createModel(data)
                },
            }
        }).mount('#app')
    </script>
@endsection
