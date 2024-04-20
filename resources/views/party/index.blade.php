@extends('layouts.app')
@section('title', $title)
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!-- Multi Columns Form -->
            <form class="row g-3 pt-3">
              <div class="col-md-3">
                <label for="inputCName" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="inputCName">
              </div>
              <div class="col-md-3">
                <label for="inputCcode" class="form-label">Customer Code</label>
                <input type="text" class="form-control" id="inputCName">
              </div>
              <div class="col-md-3">
                <label for="inputPhone" class="form-label">Phone No</label>
                <input type="number" class="form-control" id="inputPhone">
              </div>
              <div class="col-md-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail">
              </div>
              <div class="col-md-3">
                <label for="inputStatus" class="form-label">Status</label>
                <select class="fstdropdown-select form-control" id="example">
                  <option selected>Choose...</option>
                  <option>Active</option>
                  <option>Inactive</option>
                </select>
              </div>
              <div class="col-md-3 mt-3 pt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> &nbsp;Search</button>
                <a href="{{url('party/add')}}" type="submit" class="btn btn-success"><i class="bi bi-plus"></i> &nbsp;Add Customer</a>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
        <div class="card">
          <div class="card-body mt-4">
            <!-- Table with stripped rows -->
            <div class="">
             
                <table class="table table-bordered ">
                  <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Customer code</th>
                      <th>Phone No</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr data-index="0">
                      <td>Unity Pugh</td>
                      <td>Dummy</td>
                      <td>123524685</td>
                      <td>test@gmail.com</td>
                      <td>Active</td>
                      <td> <a href="add-customer.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a><a href="view-customer.html"><i class="bi bi-eye mx-2"></i></a></td>
                    </tr>
                    <tr data-index="1">
                      <td>Unity Pugh</td>
                      <td>Dummy</td>
                      <td>123524685</td>
                      <td>test@gmail.com</td>
                      <td>Active</td>
                      <td> <a href="add-customer.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a><a href="view-customer.html"><i class="bi bi-eye mx-2"></i></a></td>
                    </tr>
                    <tr data-index="2">
                      <td>Unity Pugh</td>
                      <td>Dummy</td>
                      <td>123524685</td>
                      <td>test@gmail.com</td>
                      <td>Active</td>
                      <td> <a href="add-customer.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a><a href="view-customer.html"><i class="bi bi-eye mx-2"></i></a></td>
                    </tr>
                    <tr data-index="3">
                      <td>Unity Pugh</td>
                      <td>Dummy</td>
                      <td>123524685</td>
                      <td>test@gmail.com</td>
                      <td>Active</td>
                      <td> <a href="add-customer.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a><a href="view-customer.html"><i class="bi bi-eye mx-2"></i></a></td>
                    </tr>
                    <tr data-index="4">
                      <td>Unity Pugh</td>
                      <td>Dummy</td>
                      <td>123524685</td>
                      <td>test@gmail.com</td>
                      <td>Active</td>
                      <td> <a href="add-customer.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a><a href="view-customer.html"><i class="bi bi-eye mx-2"></i></a></td>
                    </tr>
                    
                  </tbody>
                </table>
              <div class="datatable-bottom">
                <div class="datatable-info">Showing 1 to 10 of 100 entries</div>
                <nav class="datatable-pagination">
                  <ul class="datatable-pagination-list">
                    <li class="datatable-pagination-list-item datatable-hidden datatable-disabled"><button
                        data-page="1" class="datatable-pagination-list-item-link" aria-label="Page 1">‹</button></li>
                    <li class="datatable-pagination-list-item datatable-active"><button data-page="1"
                        class="datatable-pagination-list-item-link" aria-label="Page 1">1</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="2"
                        class="datatable-pagination-list-item-link" aria-label="Page 2">2</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="3"
                        class="datatable-pagination-list-item-link" aria-label="Page 3">3</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="4"
                        class="datatable-pagination-list-item-link" aria-label="Page 4">4</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="5"
                        class="datatable-pagination-list-item-link" aria-label="Page 5">5</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="6"
                        class="datatable-pagination-list-item-link" aria-label="Page 6">6</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="7"
                        class="datatable-pagination-list-item-link" aria-label="Page 7">7</button></li>
                    <li class="datatable-pagination-list-item datatable-ellipsis datatable-disabled"><button
                        class="datatable-pagination-list-item-link">…</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="10"
                        class="datatable-pagination-list-item-link" aria-label="Page 10">10</button></li>
                    <li class="datatable-pagination-list-item"><button data-page="2"
                        class="datatable-pagination-list-item-link" aria-label="Page 2">›</button></li>
                  </ul>
                </nav>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script type="text/javascript" src="/assets/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
<script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
<script type="text/javascript" src="{{url('public/validations/lead.js')}}"></script>@endsection
