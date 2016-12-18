@extends('app')

@section('title', '儀錶板')

@section('content')
    <div class="ui container">
        <h1 class="ui center aligned teal header">環境資料</h1>
        @if($hasSensor)
{{--            {{ dd($temperature) }}--}}
            @if($temperature)
                <canvas id="LineChart" style="width:50%;"></canvas>
            @endif
        @else
            <div class="ui warning icon message">
                <i class="warning sign icon"></i>
                <div class="content">
                    <div class="header">
                        系統中似乎沒有任何感測器或感測器都沒有回傳資料呢！
                    </div>
                    <p>到 管理選單 &gt; 感測器管理 去看一下感測器設定吧！ </p>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
      const temp = JSON.parse('{!! json_encode($temperature) !!}')
      let label = [];
      let datas = [];
      for(let t in temp) {
        label.push(t);
        datas.push(temp[t]);
      }
      let data = {
        labels: label,
        datasets:[{
          label: "Temperature",
          lineTension: 0.1,
          backgroundColor: "rgba(75,192,192,0.4)",
          borderColor: "rgba(75,192,192,1)",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "rgba(75,192,192,1)",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 1,
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(75,192,192,1)",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          pointHoverBorderWidth: 2,
          pointRadius: 1,
          pointHitRadius: 10,
          data:datas,
          spanGaps: false,
          fill: false
        }],
      };
      console.log(data);
      const ctx = document.getElementById('LineChart');
      let linehart = new Chart(ctx, {
        type: 'line',
        data: data,
      });

    </script>
@endsection