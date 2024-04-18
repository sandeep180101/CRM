@extends('layouts.app')
@section('title', 'Lead')
@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body mt-3">
            <!-- Vertical Form -->
            <form class="row g-3">
                <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
                <input type="text" class="form-control" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}" hidden>
              <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="{{isset($singleData['name']) ? $singleData['name'] : ''}}">
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="{{isset($singleData['email']) ? $singleData['email'] : ''}}">
              </div>
              <div class="col-12">
                <label for="phone" class="form-label">Phone No</label>
                <input type="number" class="form-control" id="phone" value="{{isset($singleData['phone']) ? $singleData['phone'] : ''}}">
              </div>
              <div class="col-md-12">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Choose..." class="form-select mb-2">
                    <option value="0" {{isset($singleData['status']) && $singleData['status'] == 0 ? 'selected' : ''}}>Active</option>
                    <option value="1" {{isset($singleData['status']) && $singleData['status'] == 1 ? 'selected' : ''}}>Inactive</option>
                </select>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-purple"><i class="bi bi-floppy"></i> &nbsp;Submit</button>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone No</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Brandon Jacob</td>
                  <td>Designer@gmail.com</td>
                  <td>285465821452</td>
                  <td>Active</td>
                  <td> <a href="add-lead.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a></td>
                </tr>
                <tr>
                  <td>Brandon Jacob</td>
                  <td>Designer@gmail.com</td>
                  <td>285465821452</td>
                  <td>Active</td>
                  <td> <a href="add-lead.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a></td>
                </tr>
                <tr>
                  <td>Brandon Jacob</td>
                  <td>Designer@gmail.com</td>
                  <td>285465821452</td>
                  <td>Active</td>
                  <td> <a href="add-lead.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a></td>
                </tr>
                <tr>
                  <td>Brandon Jacob</td>
                  <td>Designer@gmail.com</td>
                  <td>285465821452</td>
                  <td>Active</td>
                  <td> <a href="add-lead.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a></td>
                </tr>
                <tr>
                  <td>Brandon Jacob</td>
                  <td>Designer@gmail.com</td>
                  <td>285465821452</td>
                  <td>Active</td>
                  <td> <a href="add-lead.html"><i class="bi bi-pencil-square mx-1"></i></a><a href="#"><i class="bi bi-trash mx-2"></i></a></td>
                </tr>
            
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection