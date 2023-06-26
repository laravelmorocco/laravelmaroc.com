@extends('layouts.dashboard')


@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Menu Builder</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>Home</a></li>
            <li class="breadcrumb-item">Menu Builder</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h3 class="card-title">Menu Builder</h3>
                    <div class="card-tools d-flex">
                        <button id="updateMenu" class="btn bg-pink-500 text-white active:bg-pink-600 focus:ring-pink-500 btn-sm mr-4">Update Main Menu</button>
                        <div class="d-inline-block mr-4">
                            <select class="form-control lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                @foreach($langs as $lang)
                                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Add/Edit/Update Area</h6>
                                    </div>
                                    <div class="card-body">
                                        <form id="frmEdit" class="form-horizontal">
                                            <input class="item-menu" type="hidden" name="type" value="">
        
                                            <div id="withUrl">
                                                <div class="form-group">
                                                    <label for="text">Text</label>
                                                    <input type="text" class="form-control item-menu" name="text" placeholder="Text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="href">URL</label>
                                                    <input type="text" class="form-control item-menu" name="href" placeholder="URL">
                                                </div>
                                                <div class="form-group">
                                                    <label for="target">Target</label>
                                                    <select name="target" id="target" class="form-control item-menu">
                                                        <option value="_self">Self</option>
                                                        <option value="_blank">Blank</option>
                                                        <option value="_top">Top</option>
                                                    </select>
                                                </div>
                                            </div>
        
                                            <div id="withoutUrl" style="display: none;">
                                                <div class="form-group">
                                                    <label for="text">Text</label>
                                                    <input type="text" class="form-control item-menu" name="text" placeholder="Text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="href">URL</label>
                                                    <input type="text" class="form-control item-menu" name="href" placeholder="URL">
                                                </div>
                                                <div class="form-group">
                                                    <label for="target">Target</label>
                                                    <select name="target" class="form-control item-menu">
                                                        <option value="_self">Self</option>
                                                        <option value="_blank">Blank</option>
                                                        <option value="_top">Top</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" id="btnUpdate" class="btn btn-info btn-sm" disabled><i class="fas fa-sync-alt"></i> Update Menu</button>
                                        <button type="button" id="btnAdd" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Menu</button>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Main Menu Area</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul id="myEditor" class="sortableLists list-group">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Pre-Made Menu Area</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">

                                            <li class="list-group-item">{{__('Home')}} <a data-text="{{__('Home')}}" data-type="home" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a></li>
        
                                            <li class="list-group-item">{{__('About')}}
                                                <a data-text="{{__('About')}}" data-type="about" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('Services')}}
                                                <a data-text="{{__('Services')}}" data-type="services" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
                                         
        
                                            <li class="list-group-item">{{__('Portfolios')}}
                                                <a data-text="{{__('Portfolios')}}" data-type="projects" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
                                            <li class="list-group-item">{{__('Pages')}}
                                                <a data-text="{{__('Pages')}}" data-type="pages" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('Packages')}}
                                                <a data-text="{{__('Packages')}}" data-type="packages" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('Team')}}
                                                <a data-text="{{__('Team')}}" data-type="team" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('FAQ')}}
                                                <a data-text="{{__('FAQ')}}" data-type="faq" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('Gallery')}}
                                                <a data-text="{{__('Gallery')}}" data-type="gallery" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('Career')}}
                                                <a data-text="{{__('Career')}}" data-type="career" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
                                            <li class="list-group-item">{{__('Blogs')}}
                                                <a data-text="{{__('Blogs')}}" data-type="blogs" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('Products')}} 
                                                <span class="badge badge-success">Mega Menu</span>
                                                <a data-text="{{__('Products')}}" data-type="products-mega" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
                                            <li class="list-group-item">{{__('Products')}} 
                                                <span class="badge badge-info">Normal Link</span>
                                                <a data-text="{{__('Products')}}" data-type="products" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            <li class="list-group-item">{{__('Contact')}}
                                                <a data-text="{{__('Contact')}}" data-type="contact" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
        
                                            @foreach ($pages as $page)
                                            <li class="list-group-item">
                                                {{$page->title}}
                                                <a data-text="{{$page->title}}" data-type="{{$page->id}}" data-custom="yes" class="addToMenus btn btn-info btn-sm float-right" href=""><i class="fas fa-plus"></i></a>
                                            </li>
                                            @endforeach
        
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection


@section('script')
<script src="{{ asset('assets/admin/js/menu.js') }}"></script>

<script>
    jQuery(document).ready(function () {
    /* =============== DEMO =============== */
    // menu items
    var arrayjson = {!! json_encode($prevMenu) !!};

    // icon picker options
    var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
    // sortable list options
    var sortableListOptions = {
        placeholderCss: {'background-color': "#ddd"}
    };

    var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
    editor.setForm($('#frmEdit'));
    editor.setUpdateButton($('#btnUpdate'));
    // $('#btnReload').on('click', function () {

    editor.setData({!! $prevMenu !!});
    // });

    $('#updateMenu').on('click', function () {
        var str = editor.getString();
        let fd = new FormData();
        // fd.append('language_id', );
        fd.append('str', str);
        fd.append('language_id', {{$lang_id}});

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('admin.menu.update')}}",
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if(data.status == 'error') {
                    error(data.message);
                } else {
                    success(data.message);
                }
            }
        });
    });


    $("#btnUpdate").click(function(){
        disableWithoutUrl();
        editor.update();
        enableWithoutUrl();
    });

    $('#btnAdd').click(function(){
        disableWithoutUrl();
        $("input[name='type']").val('custom');
        editor.add();
        enableWithoutUrl();
    });
    /* ====================================== */

    // when menu is chosen from readymade menus list
    $(".addToMenus").on('click', function(e) {
        e.preventDefault();
        disableWithUrl();
        $("input[name='type']").val($(this).data('type'));
        $("#withoutUrl input[name='text']").val($(this).data('text'));
        $("#withoutUrl input[name='target']").val('_self');
        editor.add();
        enableWithUrl();

        if ($(this).data('type').indexOf('mega') > -1) {
            $("#myEditor").find("span.txt").last().after(" <span class='ml-2 badge badge-danger'>Mega Menu</span>");
        }

    });


});
</script>
@endsection
