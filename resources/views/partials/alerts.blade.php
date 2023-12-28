@session('success')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ $value }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endsession

                        @session('failure')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $value }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endsession
