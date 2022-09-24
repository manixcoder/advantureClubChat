<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <?php $curr_tab = Request::segment(1) ?? 'countries'; ?>
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Locations </h4>
                <ol class="breadcrumb pull-right">
                    <?php if ($curr_tab == 'countries' || $curr_tab == '') { ?>
                        <li><a href="{{URL::to('countries/add')}}" class="waves-effect"><img src="{{ asset('/public/images/add_user.png')}}">&nbsp;&nbsp;<span>Create Country</span></a>
                        <?php } elseif ($curr_tab == 'cities') { ?>
                        <li><a href="{{URL::to('cities/add')}}" class="waves-effect"><img src="{{ asset('/public/images/add_user.png')}}">&nbsp;&nbsp;<span>Create City</span></a>
                        <?php } elseif ($curr_tab == 'regions') { ?>
                        <li><a href="{{URL::to('regions/add')}}" class="waves-effect"><img src="{{ asset('/public/images/add_user.png')}}">&nbsp;&nbsp;<span>Create Region</span></a>
                        <?php } ?>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th width="75px">Country ID</th>
                            <th>Country Name</th>
                            <th>Flag</th>
                            <th>Currency</th>
                            <th>Created By</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($countries as $data) { 
                            //dd($data);
                            ?>
                            <tr>
                                <td>#{{ $i }}</td>
                                <td>{{ $data->country }}</td>
                                <td>
                                    <?php if ($data->flag != '') { ?>
                                        <img src="{{ URL::to('/public/')}}/{{ $data->flag }}" style="width: 57px;height: 37px;">
                                    <?php } ?>
                                </td>
                                <td>{{ $data->currency }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                                <td class="actions">
                                    <a href="{{ URL::to('countries/delete', $data->id)}}" class="on-default remove-row" onclick="return confirm('Are you sure you want to delete this item?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
            @yield('', View::make('admin.locations.location_sidebar'))
        </div>
    </div>
</div>