<?php
$lat = $data->latitude ?? '24.65442475109588';
$lng = $data->longitude ?? '46.709548950195305';
?>
{{ Form::open( ['route' => ['restaurants.update',['id'=>$data->id]],'method'=>'post', 'files'=>'true'] ) }}
@include('admin.restaurants.form')
{{ Form::close() }}

