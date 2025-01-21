@extends("dashboard.layout")

@section("tab-title", "Dashboard")
@section("dashboard_activation", "active")

@section("content")
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- No. of Events Card -->
          <div class="col-sm-12 col-md-6 col-xxl-3">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">No. of Events</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-calendar2-event"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ str_pad("". $all_events, 2, 0, STR_PAD_LEFT) }}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Opened Events Card -->
          <div class="col-sm-12 col-md-6 col-xxl-3">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Opened Events</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-calendar-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ str_pad("". $active_events->count(), 2, 0, STR_PAD_LEFT) }}</h6>

                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Closed Events Card -->
          <div class="col-sm-12 col-md-6 col-xxl-3">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Closed Events</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-calendar-x"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ str_pad("".$all_events - $active_events->count(), 2, 0, STR_PAD_LEFT) }}</h6>
                  </div>
                </div>

              </div>
            </div>

          </div>

          <!-- No. of Attendees Card -->
          <div class="col-sm-12 col-md-6 col-xxl-3">

            <div class="card info-card attendee-card">

              <div class="card-body">
                <h5 class="card-title">All Attendees</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ str_pad("". $attendees, 2, 0, STR_PAD_LEFT) }}</h6>
                  </div>
                </div>

              </div>
            </div>

          </div>

          <!-- Reports -->
          <div class="col-12">
            <div class="card">

              <div class="card-body">
                <h5 class="card-title">Reports</h5>

                <!-- Line Chart -->
                <div id="reportsChart"></div>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    const eventNames = @json($eventNames);
                    const attendeesCount = @json($attendeesCount);
                    const confirmedAttendeesCount = @json($confirmedAttendeesCount);
                    const declinedAttendeesCount = @json($declinedAttendeesCount);
                    const pendingAttendeesCount = @json($pendingAttendeesCount);

                    const categories = eventNames.map((name, index) => {
                      return `${name}`;
                    });

                    new ApexCharts(document.querySelector("#reportsChart"), {
                      series: [
                        {
                          name: 'All Attendees',
                          data: attendeesCount
                        },
                        {
                          name: 'Confirmed',
                          data: confirmedAttendeesCount
                        },
                        {
                          name: 'Declined',
                          data: declinedAttendeesCount
                        },
                        {
                          name: 'Pending',
                          data: pendingAttendeesCount
                        },
                    ],
                      chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                          show: false
                        },
                      },
                      markers: {
                        size: 4
                      },
                      colors: ['#ff7900', '#91cc75', '#dc3545', '#0d6efd'],
                      fill: {
                        type: "gradient",
                        gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                        }
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'smooth',
                        width: 2
                      },
                      xaxis: {
                        categories: categories,
                        labels: {
                          style: {
                            fontSize: '14px',
                            fontWeight: 'bold'
                          }
                        }
                      }
                    }).render();
                  });
                </script>
                <!-- End Line Chart -->

              </div>

            </div>
          </div><!-- End Reports -->
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Recent Activity -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Recent Events</h5>

            <div class="activity">

              @foreach ($active_events->take(5) as $event)
                <div class="activity-item d-flex">
                  <div class="activite-label pe-1 text-truncate" style="width: 40px">
                    {{
                      Carbon\Carbon::parse($event->start_date_time)->diffForHumans();
                    }}
                  </div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content fw-bold">
                    <a href="{{ route('event.show', $event) }}">
                      {{ $event->title }}
                    </a>
                  </div>
                </div>
              @endforeach

            </div>

          </div>
        </div><!-- End Recent Activity -->

        <!-- Website Traffic -->
        <div class="card">

          <div class="card-body pb-0">
            <h5 class="card-title">Event Traffic</h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
              let events = @json($events);
              let data = [];
              for(let i = 0; i < 4; i++){
                let record = {
                  value: events[i].attendees.length,
                  name: events[i].title
                };
                data.push(record);
              }
              document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#trafficChart")).setOption({
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    // top: '5%',
                    left: 'center'
                  },
                  series: [{
                    name: 'Attendees',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                      show: false,
                      position: 'center'
                    },
                    emphasis: {
                      label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                      }
                    },
                    labelLine: {
                      show: false
                    },
                    data: data
                  }]
                });
              });
            </script>

          </div>
        </div><!-- End Website Traffic -->

      </div><!-- End Right side columns -->

    </div>
  </section>
@endsection