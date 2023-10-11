@extends('layoutuser.app')
@section('section')

	<!-- ================ Start Page Title ======================= -->
    <section class="title-transparent page-title" style="background:url(http://via.placeholder.com/1920x850);">
        <div class="container">
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ================ End Page Title ======================= -->
    
    <!-- ================ Profile Name Section ======================= -->
    <section class="padd-0">
        <div class="container">
            <div class="col-md-12 translateY-60 col-sm-12">
                <!-- General Information -->
                <div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
                    <div class="listing-box-header">
                        <div class="avater-box">
                        <img src="assets/img/avatar.jpg" class="img-responsive img-circle edit-avater" alt="" />
                        <span class="avater-status status-pulse online"></span>
                        </div>
                        <h3>Daniel M. Dev</h3>
                        <p>270 Listing</p>
                    </div>
                </div>
                <!-- End General Information -->
            </div>
        </div>
    </section>
    <!-- ================ End Profile Name Section ======================= -->
    
    <!-- ================ Start Manage Listing ======================= -->
    <section class="manage-listing padd-top-0">
        <div class="container">
            <div class="col-md-12 col-sm-12">
                <!-- Filter Option -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Sort By:</label>
                                    <div class="col-xs-9">
                                        <select class="form-control">
                                            <option value="download_name_tag" selected="selected">Theme Name</option>
                                            <option value="timestamp">Last Updated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Author:</label>
                                    <div class="col-xs-9">
                                        <select class="form-control">
                                            <option value="download_name_tag" selected="selected">Theme Name</option>
                                            <option value="timestamp">Last Updated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="full-right search-wrapper">
                            <input type="search" class="form-control" placeholder="Filter by keyword...">
                        </div>
                    </div>
                </div>
                <!-- End Filter Option -->
                
                <!-- Start All Listing List -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="small-list-wrapper">
                        <ul>
                            <li>
                                <div class="small-listing-box light-gray">
                                    <div class="small-list-img">
                                        <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="" />
                                    </div>
                                    <div class="small-list-detail">
                                        <h4>Pizza Bridge Lite</h4>
                                        <p><a href="#" title="Food & restaurant">Food & restaurant</a> | Jan 10 2018</p>
                                    </div>
                                    <div class="small-list-action">
                                        <a href="#" class="light-gray-btn btn-square" data-placement="top" data-toggle="tooltip" title="Edit Item"><i class="ti-pencil"></i></a>
                                        <a href="#" class="theme-btn btn-square" data-toggle="tooltip" title="Delete Item"><i class="ti-trash"></i></a>
                                    </div>
                                </div>
                            </li>
                        
                           
                            <li>
                                <div class="small-listing-box light-gray">
                                    <div class="small-list-img">
                                        <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="" />
                                    </div>
                                    <div class="small-list-detail">
                                        <h4>Pizza Bridge Lite</h4>
                                        <p><a href="#" title="Food & restaurant">Food & restaurant</a> | Jan 10 2018</p>
                                    </div>
                                    <div class="small-list-action">
                                        <a href="#" class="light-gray-btn btn-square" data-placement="top" data-toggle="tooltip" title="Edit Item"><i class="ti-pencil"></i></a>
                                        <a href="#" class="theme-btn btn-square" data-toggle="tooltip" title="Delete Item"><i class="ti-trash"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
                <!-- End All Listing List -->
            </div>
        </div>
    </section>
@endsection