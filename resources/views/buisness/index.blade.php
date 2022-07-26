@if(isset($success))
    <div style="color: green">{{$success}}</div><br/><br/>
@endif

@if(isset($error))
    <div style="color:red"> {{$error}}</div><br/><br/>
@endif


<table border="1" cellspacing="0">
    <thead>
        <th>Sl.</th>
        <th>Name</th>
        <th>Address</th>
        <th>Image</th>
        <th>Restaurant type name</th>
        <th>Time</th>
        <th>Action</th>
    </thead>
    <tbody>

    @foreach($data as $list)
        <?php
            if(!empty($list['restaurant_type'])){
                $type = $list['restaurant_type'];
                $typeName = $type[0]['name'];
            }else{
                $typeName = "N/A";
            }

            if(!empty($list['time_available'])){
                $timeArray = [];
                $times = $list['time_available'];
                foreach ($times as $time){
                    array_push($timeArray,$time['time']);
                }
                $timeString = implode(",",$timeArray);

                $insertData = [
                    'name' => $list['business_name'],
                    'time' => json_encode($timeArray),
                    'unique_id' => $list['id']
                ];

            }else{
                $timeString = "N/A";
            }
        ?>
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $list['business_name'] }}</td>
            <td>{{ $list['address'] }}</td>
            <td><img srs="{{ $list['image'] }}" height="100px" width="100px"/></td>
            <td>{{ $typeName }}</td>
            <td>{{ $timeString }}</td>
            <td>
                <?php
                    if($timeString != "N/A"){
                ?>
                <a href="/insert/{{serialize($insertData)}}">Insert Data</a>
                <?php
                    }else{
                        echo "No action available.";
                    }
                ?>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
