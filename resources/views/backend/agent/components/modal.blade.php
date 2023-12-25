@if ($proposal == null)
    <div class="modal fade" id="AgentSendProposal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('general.Send Proposal') }}</h3>
                    <p class="text-muted">{{ __('general.Add a price quote for the project') }}</p>
                </div>
                <form id="addProposal" class="row g-3" method="POST" action="{{ route('agent.project.addProposal', $project->id) }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="budget">{{ __('general.Add Budget') }} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="budget" name="budget" class="form-control" type="number" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="note">{{ __('general.Add Note') }}</label>
                        <div class="input-group input-group-merge">
                            <textarea id="note" name="note" class="form-control" type="text" ></textarea>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="col-md">
                            <small class="text-dark">The Budget ncludes</small>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="Clearance" checked="" id="Clearance">
                                <label class="form-check-label" for="Clearance">
                                    Clearance
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Transport" id="Transport" checked="">
                                <label class="form-check-label" for="Transport">
                                    Transport
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">{{ __('general.Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    @else
    {{-- add millstone --}}
    <div class="modal fade" id="AgentAddCustomMillstone" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('general.custom millstone') }}</h3>
                    <p class="text-muted">{{ __('general.Add a custom millstone for the project') }}</p>
                </div>
                <form id="addProposal" class="row g-3" method="POST" action="{{ route('agent.add.CustomMillstone', $project->id) }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="name">{{ __('general.millstone name') }} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="name" name="name" class="form-control" type="text" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="desc">{{ __('general.Description') }}</label>
                        <div class="input-group input-group-merge">
                            <textarea id="desc" name="desc" class="form-control" type="text" ></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">{{ __('general.Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    {{-- send invoice to client --}}
    <div class="modal fade" id="AgentAddInvoice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('general.Send Invoice') }}</h3>
                    <p class="text-muted">{{ __('general.Send invoice to customer') }}</p>
                </div>
                <form id="addProposal" class="row g-3" method="POST" action="{{ route('agent.add.CustomInvoice', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if ($project->payment_mode == 2)

                    <div class="row p-0 m-0">
                        <div class="col-md px-1 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic checked">
                                <label class="form-check-label custom-option-content" for="invType1">
                                    <input name="invType" class="form-check-input" type="radio" value="1" id="invType1" checked="">
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">{{ __('general.payed invoice') }}</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ __('general.The balance will be added to your wallet') }}</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md px-1">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="invType2">
                                    <input name="invType" class="form-check-input" type="radio" value="2" id="invType2">
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">{{ __('general.Request to clearforce') }}</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ __('general.Request funding from the platform') }}.</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>    
                    @else
                    <input type="hidden" name="invType" value="0"> 
                    @endif
                    <div class="col-12">
                        <label for="flatpickr-date" class="form-label">{{ __('general.due date') }}</label>
                        <input type="date" class="form-control" name="due_date" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="invoice_file">{{ __('general.A copy of "invoice file"') }} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="invoice_file" name="invoice_file" value="{{ old('invoice_file') }}" class="form-control  @error('invoice_file') is-invalid @enderror" type="file" />
                        </div>
                        @error('invoice_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label w-100" for="code">{{ __('general.Code or Link') }} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="code" name="code" class="form-control" type="text" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="total">{{ __('general.Total Amount') }}  <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="amount" name="amount" class="form-control" type="number" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="desc">{{ __('general.Invoice details') }}  <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <textarea id="desc" name="desc" class="form-control" type="text" required></textarea>
                        </div>
                    </div>
                    
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">{{ __('general.Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    {{-- complete project request --}}
    @if ($project->status == 2)
    <div class="modal fade" id="SendCompleteRequest" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h4 class="mb-2">{{ __('general.Send request to terminate the clearance') }}</h4>
                </div>
                <form class="row g-3" method="POST" action="{{ route('agent.request.endproject', $project->uuid) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100 " for="certification">{{ __('general.The latest copy of the customs declaration') }} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="certification" name="certification" value="{{ old('certification') }}" class="form-control  @error('certification') is-invalid @enderror" type="file" placeholder="" required />
                        </div>
                        @error('certification')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="restrictions">{{ __('general.Are there any restrictions on the shipment?') }} </label>
                        <div class="input-group">
                            <input type="text" id="restrictions" class="form-control @error('restrictions') is-invalid @enderror" value="{{ old('restrictions') }}" name="restrictions" >
                        </div>
                        @error('restrictions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <p class="text-muted">{{ __('general.I declare that I have completed the work in accordance with the') }} <a href="{{ route('privacy') }}">{{ __('general.Privacy_Policy') }}</a></p>
                    </div>
                    <div class="col-12 mt-3 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">{{ __('general.Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    {{-- edit request --}}
    <div class="modal fade" id="editCompleteRequest" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('general.Edit request') }}</h3>
                </div>
                <form class="row g-3" method="POST" action="{{ route('agent.edit.request.endproject', $project->uuid) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100 " for="data-file">{{ __('general.The latest copy of the customs declaration') }} </label>
                        <div class="input-group input-group-merge">
                            <input id="data-file" name="certification" class="form-control  @error('certification') is-invalid @enderror" type="file" />
                        </div>
                        @error('certification')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        
                        <label class="form-label w-100" for="data-restrictions">{{ __('general.Are there any restrictions on the shipment?') }} </label>
                        <div class="input-group">
                            <input type="text" id="data-restrictions" class="form-control @error('restrictions') is-invalid @enderror"  name="restrictions" >
                        </div>
                        @error('restrictions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <p class="text-muted">{{ __('general.I declare that I have completed the work in accordance with the') }} <a href="{{ route('privacy') }}">{{ __('general.Privacy_Policy') }}</a></p>
                    </div>

                    <div class="col-12 mt-3 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">{{ __('general.edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    @endif
@endif
