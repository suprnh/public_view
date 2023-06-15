@extends('admin.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">Banner Management</h1>
</div>
@stop
@section('dashboard')
            <div class="row">

                @if (Session::has('success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                </div></div>
                @endif

                @if (Session::has('error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                </div></div>
                @endif

                <div class="row"><div class="col-md-12">
                <form name = "frm" action = "<?php if(!empty($oneBanner)) {?>{{ route('update-banner') }}<?php } else { ?>{{ route('upload-banner') }}<?php } ?>" method = "post" enctype = "multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label>Upload Banner (1920 x 851)</label>
                        <?php if(!empty($oneBanner)) {?>
                            <img src="<?php echo get_recource_url($oneBanner->image_id); ?>" style="width:300px; height:150px; border:1px solid silver;"><br/>
                        <?php } ?>
                        <input type="file" name="banner_img" accept="image/*">
                        @if($errors->has('banner_img'))
                        <span style="color:RED;"><small>{{$errors->first('banner_img')}}</small></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Banner Title</label>
                        <input type="text" name="banner_title" class="form-control" value="<?php if(!empty($oneBanner)) echo $oneBanner->title; ?>">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="status" value="1" <?php if(!empty($oneBanner) && $oneBanner->status == 1) { ?> checked <?php }else{ ?> checked <?php } ?>> Active
                        <input type="radio" name="status" value="0" <?php if(!empty($oneBanner) && $oneBanner->status == 0) { ?> checked <?php } ?>> Inactive
                    </div>
                    <div class="form-group">
                        <?php if(!empty($oneBanner)) { ?>
                        <input type="submit" name="ok" value="Update Banner" class="btn btn-primary">
                        <a href="{{ route('banner-management') }}" class="btn btn-danger">Cancel</a>
                        <input type="hidden" name="banner_id" value="<?php echo $oneBanner->ID; ?>">
                        <input type="hidden" name="prev_image_id" value="<?php echo $oneBanner->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="ok" value="Upload Now" class="btn btn-primary">
                        <?php } ?>
                    </div>
                </form>
                </div></div>

                <?php if(empty($oneBanner)) { ?>
                <div class="row"><div class="col-md-12">
                <?php
                if(!empty($banners))
                {
                ?>
                <table>
                    <tr>
                        <?php
                        $i=0;
                        foreach($banners as $b){
                            if($i % 3 == 0)
                            {
                                echo "<tr></tr>";
                            }
                        ?>
                            <td style="padding: 10px;">
                                <img src="<?php echo get_recource_url($b->image_id); ?>" style="width:300px; height:150px; border:1px solid silver;" <?php if($b->status == 0) { ?> class="inactive" <?php } ?>>
                                <a href="{{ route('banner-management') }}/{{ $b->ID }}" class="btn btn-xs btn-success">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a href="{{ route('del-banner') }}/{{ $b->ID }}" class="btn btn-xs btn-danger" onclick="return confirm('Sure To Delete this Banner ?')">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                        <?php
                        $i++;
                        }
                        ?>
                    </tr>
                </table>
                <?php
                }
                ?>
                </div></div>
                <?php } ?>

            </div>
@stop