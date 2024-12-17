Remove-Item -Recurse -Force .git // yakın depo kaldırma

//reports expensecontroller
 $month = DB::select('SELECT MONTH(e.date) AS month,SUM(e.amount) AS total_amount
        FROM  expenses e JOIN  userex u ON e.user_id = u.id where e.user_id = :user_id
         GROUP BY MONTH(e.date) ORDER BY month Asc;', ['user_id' => session('user_id')]);

        $expense = DB::select('SELECT e.description,MONTH(e.date) AS month, e.title AS title,SUM(e.amount) AS total_amount
        FROM  expenses e JOIN  userex u ON e.user_id = u.id where e.user_id = :user_id
         GROUP BY MONTH(e.date), e.title,e.description ORDER BY month Asc;', ['user_id' => session('user_id')]);

        return view('expense.reports', compact('expense', 'month'));

//login buton 
  @if (!empty($user))
                        <li class="nav-item dropdown">
                            <button class="btn btn-link dropdown-toggle d-flex align-items-center" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Kullanıcı Adı -->
                                {{ $user->name }}
                                <!-- Logout Butonu (yan yana) -->
                                <span class="ms-2">
                                    <button class="btn btn-link">
                                        Logout
                                    </button>
                                </span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Menü öğeleri (Opsiyonel) -->
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login
                            </button>
                        </li>
                    @endif

//middleware

                     view()->share('user', null);
                return redirect('harcama/login')->with('message', $message)
                    ->with('status', $status);
            }
            $user = Userex::where('id', session('user_id'))->first();

            // Kullanıcı verisini tüm Blade görünümlerine ilet
            view()->share('user', $user);
            return $next($request);
// reports.blade

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (jQuery ve Popper.js gereklidir) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<div class="container mt-2">
  <h2 class="mb-4">Harcamalar ve Gelir Raporları</h2>


  <div class="collapse-section">
    @foreach ($month as $mon)
    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseTable{{ $mon->month }} "
      aria-expanded="false" aria-controls="collapseTable{{ $mon->month }}">
      {{ $mon->month }} <!-- Ay ismi burada yer alacak -->
    </button>
    @endforeach
    @foreach ($month as $mon)
      <div class="collapse" id="collapseTable{{ $mon->month }}">
        <div class="table-container mt-2">
        <table class="table table-striped">
          <h3>{{ \Carbon\Carbon::createFromFormat('m', $mon->month)->locale('tr')->isoFormat('MMMM') }}


          </h3>
          <thead>
          <tr>

            <th scope="col">Kategori</th>
            <th scope="col">Tutar</th>
            <th scope="col">Tür</th>
          </tr>
          </thead>
          <tbody>
          @php  $totalAmount = 0; @endphp
          @foreach($expense as $ex)
        @if($ex->month == $mon->month)
        <tr>
        <td>{{ $ex->title }}</td>
        <td>{{ number_format($ex->total_amount, 2) }} TL</td>
        <td>{{ $ex->description }}</td>
        @php
      $totalAmount += $ex->total_amount;
    @endphp
        </tr>
    @endif
      @endforeach
          </tbody>
          <tfoot>
          <tr>
            <td colspan="2"><strong>Toplam Harcama:</strong></td>
            <td><strong>{{ number_format($totalAmount, 2) }} TL</strong></td>
          </tr>
          </tfoot>
        </table>
        </div>
      </div>
      </div>
    @endforeach

</div>
