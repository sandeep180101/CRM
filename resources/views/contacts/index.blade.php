@extends('layouts.app')
@section('title', "Contact")
@section('content')


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Multi Columns Form -->
                          <form class="row g-3 pt-3" id="search_filter">
                                  <div class="col-md-3"> 
                                    <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
                                      <label class="form-label">Contact Name</label>
                                      <input type="text" class="form-control" id="contact_name" name="contact_name" class="form-control"/>
                                  </div>
                                  <div class="col-md-3">
                                    <label class="form-label">Contact Name</label>Contact Email </label>
                                    <input type="text" class="form-control" id="contact_email" name="contact_email" class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                  <label class="form-label">Contact Phone </label>
                                  <input type="text" class="form-control" id="contact_phone" name="contact_phone" class="form-control"/>
                              </div>
                                  <div class="col-md-3">
                                      <label for="Status" class="form-label">Status</label>
                                      <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Choose..." class="form-select mb-2">
                                         <option value="">Select</option>
                                         <option value="0">Active</option>
                                         <option value="1">Inactive</option>
                                      </select>
                                   </div>
                                  <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                                      <a href="{{url('leads/add')}}" class="btn btn-success"><i class="bi bi-plus"></i> Add Lead</a>
                                    </div>
                              </div>
                          </form>
                        </div>
                    <div class="card">
                        <div class="card-body mt-4">
                            <!-- Table with stripped rows -->
                            <div>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" width="25%">Contact Name</th>
                                <th scope="col" width="25%">Contact Email</th>
                                <th scope="col" width="20%">Contact Phone</th>
                                <th scope="col" width="20%">Status</th>
                                <th scope="col" width="10%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($contacts as $contact)
                              <tr>
                                <td>{{ $contact->contact_name }}</td>
                                <td>{{ $contact->contact_email }}</td>
                                <td>{{ $contact->contact_phone }}</td>
                                <td>{{ $contact->status }}</td>
                                <td>
                                  <a href="{{ url('contacts/add',['id'=>$contact->id]) }}"><i class="text-black bi bi-pencil"></i></a>&nbsp;&nbsp;
                                  <a href="{{ url('contacts/delete', ['id' => $contact->id]) }}"><i class="text-black bi bi-trash3"></i></a>&nbsp;&nbsp;
                                  <a href=""><i class="text-black bi bi-eye"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          <div class="datatable-bottom">
                            <div class="datatable-info">Showing 1 to 10 of {{$contacts->count()}} entries</div>
                            <nav class="datatable-pagination">
                                <ul class="datatable-pagination-list">
                                    <li class="datatable-pagination-list-item datatable-hidden datatable-disabled"><button data-page="1" class="datatable-pagination-list-item-link" aria-label="Page 1">‹</button></li>
                                    <li class="datatable-pagination-list-item datatable-active"><button data-page="1" class="datatable-pagination-list-item-link" aria-label="Page 1">1</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="2" class="datatable-pagination-list-item-link" aria-label="Page 2">2</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="3" class="datatable-pagination-list-item-link" aria-label="Page 3">3</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="4" class="datatable-pagination-list-item-link" aria-label="Page 4">4</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="5" class="datatable-pagination-list-item-link" aria-label="Page 5">5</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="6" class="datatable-pagination-list-item-link" aria-label="Page 6">6</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="7" class="datatable-pagination-list-item-link" aria-label="Page 7">7</button></li>
                                    <li class="datatable-pagination-list-item datatable-ellipsis datatable-disabled"><button class="datatable-pagination-list-item-link">…</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="10" class="datatable-pagination-list-item-link" aria-label="Page 10">10</button></li>
                                    <li class="datatable-pagination-list-item"><button data-page="2" class="datatable-pagination-list-item-link" aria-label="Page 2">›</button></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="{{asset('validation/contact.js')}}"></script>

@endsection
