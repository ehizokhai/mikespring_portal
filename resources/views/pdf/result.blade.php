<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache" />
    <title>Student Result</title>
    <style>
      body{
        font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		margin: 0 auto;
		width: 100%;
      }
      .header {
       font-size: 14px;
       text-align: center;
       line-height: 1px;
      }
      .schoolLogo{
        max-width: 100px;
        height:70px;
      }
      table{
        width: 100%;

    border-collapse: collapse;

      }

main table, main th, main td {
    border: 1px solid black;
	font-size: 15px;
}
      .studentInfo{
        font-size: 14px;
      }
      main{
        font-size: 10px;
        font-weight: 600;
      }
  .page-break {
    page-break-after: always;
}
    </style>
    </head>
  <body>
    <table border="0"  >
      <tr>
      <?php $image_path = '/images/logomain.png'; ?>
        <td><img class="schoolLogo" src="{{ public_path() . $image_path }}" /></td>
        <td colspan="4">
            <div class="header">
                <h1>Mikespring Schools</h1>
                <h3>A Citadel of academic excellence</h3>
                <p>256 Magbon road</p>
              </div>
        </td>
        <td>
        <?php $image_paths = '/images/{{Auth::user()->passport}}'; ?>
        <td><img class="schoolLogo" src="storage/{{Auth::user()->passport}}" /></td>
        </td>
      </tr>
    </table>

    <header class="studentInfo">
<table border="0" cellpadding="1" cellspacing="1" >
  <tr><th>Surname</th><td>{{$user->lastname}} </td><th>Other Names</th><td>{{$user->firstname}} {{$user->middename}}</td>
    </tr>
    <tr>
       <th>Current Session</th> <td>{{$findSession->name}}</td>
        <th>Current Term</th> <td>{{$term->name}}</td></tr>

        <tr>
          <th>Address</th>
          <td colspan="3">
             <b>{{$user->address}}</b>
          </td>
        </tr>
</table>
    </header>
    <main>
      <table border="1" style="margin-top: 15px">
        <thead>
          <tr>
            <th class="service">Subject</th>
            <th class="desc">C.A</th>
            <th>Exam</th>
            <th>Total</th>
            <th>Grade</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
        @foreach($results as $result) 
          <tr> 
		       <td class="subject">{{$result->subject->title}}</td>
            <td class="subject">{{$result->test}}</td>
            <td class="exam">{{$result->exam}}</td>
            <td class="ca">{{$result->total}}</td>
            <td class="total">ndjhdhdh</td>
			      <td class="total">ndjhdhdh</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <table border="0" style="margin-top:10px">
        <tr><th>Position</th><th>Definition</th></tr>
        <tr><td>5th</td> <td>Average</td></tr>
        <tr><td></td> <td></td></tr>
        <tr>
          <td colspan="6">Class Teacher Remarks:</td> <td colspan="3">
            
          </td>
        </tr>
        <tr><td colspan="6">
           
          </td></tr>
      </table>

      <div id="notices">
       <!--  <div>NOTICE:</div>
       <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>-->
    </main>
    <!--<footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>-->
  </body>
</html>