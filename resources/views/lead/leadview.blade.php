@extends('layouts.app')
@section('title', $title)
@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body mt-2">
            <div class="row pt-3">
              {{-- @dd($leads); --}}
              <div class="col-md-4 mt-2"> <b>Lead Id : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->id}}</div>
              <div class="col-md-4 mt-2"> <b>Date :</b></div>
              <div class="col-md-8 mt-2">{{$leads[0]->date}}</div>
              <div class="col-md-4 mt-2"> <b>Name : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->name}}</div>
              <div class="col-md-4 mt-2"> <b>Company Name :</b></div>
              <div class="col-md-8 mt-2">{{$leads[0]->company_name}}</div>
              <div class="col-md-4 mt-2"> <b>Phone : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->phone}}</div>
              <div class="col-md-4 mt-2"> <b>Email : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->email}}</div>
              <div class="col-md-4 mt-2"> <b>Address : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->address}}</div>
              <div class="col-md-4 mt-2"> <b>Country : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->country_name}}</div>
              <div class="col-md-4 mt-2"> <b>State : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->state_name}}</div>
              <div class="col-md-4 mt-2"> <b>City: </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->city_name}}</div>
              <div class="col-md-4 mt-2"> <b>Pincode : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->pincode}}</div>
              <div class="col-md-4 mt-2"> <b>Product Interested In  : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->product_details}}</div>
              <div class="col-md-4 mt-2"> <b>Approximate Amount : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->approximate_amount}}</div>
              <div class="col-md-4 mt-2"> <b>Status : </b> </div>
              <div class="col-md-8 mt-2">{{$leads[0]->lead_status_name}}</div>
              <div class="col-md-4 mt-2"> <b>Created By :</b></div>
              <div class="col-md-8 mt-2">{{$leads[0]->uname}}    {{$leads[0]->lead_timestamp_created }}</div>
              <div class="col-md-4 mt-2"> <b>Updated By : </b> </div>
              @if(!empty($leads[0]->lead_timestamp_updated))
              <div class="col-md-8 mt-2">{{$leads[0]->uname}}   {{$leads[0]->lead_timestamp_updated }}</div>
              @endif
            </div>
            <div class=" mt-3">
              <a href="{{url('leads/add/'.Crypt::encrypt($leads[0]->id))}}" type="submit" class="btn btn-danger"><i class="bi bi-pencil-square"></i> &nbsp;Edit Lead</a>
              <a href="{{url('leads/add/'.Crypt::encrypt($leads[0]->id))}}" type="submit" class="btn btn-status"><i class="bi bi-bar-chart-line"></i> &nbsp;Change Status</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="true" role="tab">Note</button>
              </li>

              <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab" tabindex="-1">Edit Profile</button>
              </li> -->


            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

              </div>
              <div class="tab-pane fade pt-3 active show" id="profile-change-password" role="tabpanel">
                <!-- Change Password Form -->
                <form action="{{url('leadnote/view/save')}}" method="POST">
                  @csrf
                  <input type="hidden" name="lead_id" id="lead_id" value="{{$leads[0]->id}}">
                  <div class="row mb-3">
                    <div class="col-sm-12">
                      <textarea class="form-control textarea-sty_1" id="notes" name="notes" style="height: 100px"></textarea>
                    </div>
                  </div>
                  <div class="">
                    <button type="submit" class="btn btn-purple"><i class="bi bi-floppy"></i> &nbsp;Submit</button>
                  </div>
                </form>
                @if (!empty($leadnotes['results']))
                <table class="table table-bordered mt-4">
                  <tbody>
                    @foreach ($leadnotes['results'] as $note)
                    <tr>
                      @if ($note->status == "0" && $note->lead_id == $leads[0]->id)
                      <td>{{$note->notes}}<br>
                        <b>{{$note->created_at}}</b></td>
                        <td><a href="{{url('leadnote/delete/'.$note->id)}}" onclick="return confirm('Are you sure you want to delete this note?');"><i class="bi bi-trash-fill text-red"></i></a></td>
                        @endif

                      </tr>
                    @endforeach
                  </tbody>
                </table>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection