<!DOCTYPE html>
<html>
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<style>
table {
  border-collapse: collapse;
}

td, th {
  border: 1px solid #999;
  padding: 0.5rem;
  text-align: left;
}
</style>
</head>
<body>
    <?php if($salaryDetail== 'Full Time'){?>
    <h4>Salary DelaryDetatail :{{ $salaryDetail }} (1 month {{$hourly_rate}})</h4>
    <?php }else{?>
    <h4>Salary DelaryDetatail :{{ $salaryDetail }} (1 hour {{$hourly_rate}})</h4>
    <?php } ?>
     <h4>Name:{{ $name }}</h4>
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Price</th>
            <th>Name of Student</th>
            <th>Hours</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($reservationcount>0)
        { foreach($reservations as $key=>$reservation){ ?>
        <tr>
            <td><?php echo ++$key; ?></td>
            <td><?php echo $reservation['date']; ?></td>
            <td><?php echo $reservation['start_time']; ?></td>
            <td><?php echo $reservation['end_time']; ?></td>
            <td>
                <?php 
                    if($salaryDetail== 'Full Time') 
                    {
                        echo '-';
                    }      
                    else{
                        echo $reservation['price']; 
                    }          
                ?>
            </td>
            <td><?php echo $reservation['student_name']; ?></td>
            <td><?php echo $reservation['hour']; ?></td>
        </tr>
        <?php } } else {?>                   
           
           <tr></tr>
        <?php }?>
        <tr style="border:none!;">
            <th colspan="4" style="text-align: right;border:none">Amount :</th>
            <th colspan="3" style="text-align: left;border:none">{{$total}}</th>
        </tr>
        </tbody>
    </table>
    <h4>Notes</h4>
    <p>{{$note}}</p>
</body>
</html>