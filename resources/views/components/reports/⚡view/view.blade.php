<div>
    <h1>Reports</h1>

    <div class="my-8 overflow-hidden">

        <div id="yAxis" class="w-1.5 absolute">
            <div id="y5" class="border-r border-gray-200 p-5 pt-5 pb-5 text-center font-medium text-gray-400"></div>
            <div id="y4" class="border-r border-gray-200 p-5 pt-5 pb-5 text-center font-medium text-gray-400"></div>
            <div id="y3" class="border-r border-gray-200 p-5 pt-5 pb-5 text-center font-medium text-gray-400"></div>
            <div id="y2" class="border-r border-gray-200 p-5 pt-5 pb-5 text-center font-medium text-gray-400"></div>
            <div id="y1" class="border-r border-gray-200 p-5 pt-5 pb-5 text-center font-medium text-gray-400"></div>
        </div>

        <canvas id="myCanvas" width="1500" height="320"></canvas>
        @script
        <script>
            const c = document.getElementById("myCanvas");
            const ctx = c.getContext("2d");
            ctx.lineWidth = 2;
            const data = @js($this->invertedActivitiesPerDay);
            const graphHeight = 300;
            const graphWidth = 1500;
            const graphData = prepareGraphData(data);

            drawGraph(ctx, graphData);

            function prepareGraphData(data) {
                let graphData = initializeGraphData();
                graphData.xAxisStep = calculateXAxisStep(data.length);

                data.forEach(function(value, index){
                    graphData.maximumValueY = updateMaximumValueOfYAxis(graphData.maximumValueY, value);
                    graphData.xAxis.set(index, value.date);
                    graphData.yAxis.view_page_a.set(index, value.view_page_a);
                    graphData.yAxis.view_page_b.set(index, value.view_page_b);
                    graphData.yAxis.buy_a_cow_click.set(index, value.buy_a_cow_click);
                    graphData.yAxis.download_click.set(index, value.download_click);
                });

                graphData.yAxisStep = calculateYAxisStep(graphData.maximumValueY);
                setYAxisLabels(graphData.maximumValueY);

                return graphData;
            }

            function initializeGraphData() {
                return {
                    "maximumValueY": 0,
                    "yAxisStep": 100,
                    "xAxisStep": 400,
                    "xAxis": new Map(),
                    "yAxis": {
                        "view_page_a": new Map(),
                        "view_page_b": new Map(),
                        "buy_a_cow_click": new Map(),
                        "download_click": new Map(),
                    },
                    "view_page_a_color": "#ff6467",
                    "view_page_b_color": "#51a2ff",
                    "buy_a_cow_click_color": "#05df72",
                    "download_click_color": "#fdc700",
                };
            }

            function updateMaximumValueOfYAxis(maximum, data) {
                if (data.view_page_a > maximum) {
                    maximum = data.view_page_a;
                }
                if (data.view_page_b > maximum) {
                    maximum = data.view_page_b;
                }
                if (data.buy_a_cow_click > maximum) {
                    maximum = data.buy_a_cow_click;
                }
                if (data.download_click > maximum) {
                    maximum = data.download_click;
                }

                return maximum;
            }

            function calculateXAxisStep(numberOfDays) {
                return Math.floor(graphWidth / numberOfDays);
            }

            function calculateYAxisStep(maximum) {
                return Math.floor(graphHeight / maximum);
            }

            function setYAxisLabels(maximumYValue) {
                let step = Math.ceil(maximumYValue / 5);
                document.getElementById('y5').textContent = maximumYValue;
                document.getElementById('y4').textContent = String(step * 3);
                document.getElementById('y3').textContent = String(step * 2);
                document.getElementById('y2').textContent = String(step);
                document.getElementById('y1').textContent = String(0);
            }

            function drawGraph(line, data) {
                drawALine(line, data.yAxis.view_page_a, data.view_page_a_color, 0, data.yAxisStep, data.xAxisStep);
                drawALine(line, data.yAxis.view_page_b, data.view_page_b_color, 2, data.yAxisStep, data.xAxisStep);
                drawALine(line, data.yAxis.buy_a_cow_click, data.buy_a_cow_click_color, 4, data.yAxisStep, data.xAxisStep);
                drawALine(line, data.yAxis.download_click, data.download_click_color, 6, data.yAxisStep, data.xAxisStep);
            }

            function drawALine(line, days, color, offset, yAxisStep, xAxisStep) {
                line.strokeStyle = color;
                line.beginPath();

                let y = graphHeight - days.get(0) * yAxisStep - offset;

                line.moveTo(100,y);

                for (let i = 1; i < days.size; i++) {
                    y = days.get(i);
                    y = y == 0 ? graphHeight : graphHeight - y * yAxisStep;
                    line.lineTo(i * xAxisStep + 50, y -offset);
                }

                line.stroke();
            }
        </script>
        @endscript
        <table class="table-auto w-full border-collapse text-sm">
            <thead>
                <tr>
                @foreach ($this->invertedActivitiesPerDay as $date)
                    <th class="border-t border-gray-200 p-4 pt-3 pb-3 pl-8 text-center font-medium text-gray-400">{{$date->date}}</th>
                @endforeach
                </tr>
            </thead>
        </table>
    </div>

    <div class="my-8 overflow-hidden">
        <table class="table-auto w-full border-collapse text-sm">
            <thead>
                <tr>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-center font-medium text-gray-400">Date</th>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-center font-medium text-red-400">Count page view A</th>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-center font-medium text-blue-400">Count page view B</th>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-center font-medium text-green-400">Count click “Buy a cow“</th>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-center font-medium text-yellow-400">Count click “Download“</th>
                </tr>
            </thead>
            <tbody class="bg-white">

                @foreach ($this->activitiesPerDate->items() as $date)
                    <tr>
                        <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 text-center">{{$date->date}}</td>
                        <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 text-center">{{$date->view_page_a}}</td>
                        <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 text-center">{{$date->view_page_b}}</td>
                        <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 text-center">{{$date->buy_a_cow_click}}</td>
                        <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 text-center">{{$date->download_click}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    {{ $this->activitiesPerDate->links() }}
</div>
