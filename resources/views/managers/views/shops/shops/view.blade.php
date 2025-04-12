@extends('layouts.managers')

@section('content')


<div class="card">
    <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab"
                aria-controls="pills-account" aria-selected="true">
                <i class="ti ti-user-circle me-2 fs-6"></i>
                <span class="d-none d-md-block">Account</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button"
                role="tab" aria-controls="pills-notifications" aria-selected="false">
                <i class="ti ti-bell me-2 fs-6"></i>
                <span class="d-none d-md-block">Notifications</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab"
                aria-controls="pills-bills" aria-selected="false">
                <i class="ti ti-article me-2 fs-6"></i>
                <span class="d-none d-md-block">Bills</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab"
                aria-controls="pills-security" aria-selected="false">
                <i class="ti ti-lock me-2 fs-6"></i>
                <span class="d-none d-md-block">Security</span>
            </button>
        </li>
    </ul>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-account" role="tabpanel"
                aria-labelledby="pills-account-tab" tabindex="0">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold">Change Profile</h5>
                                <p class="card-subtitle mb-4">Change your profile picture from here</p>
                                <div class="text-center">
                                    <img src="./images/profile/user-1.jpg" alt="" class="img-fluid rounded-circle"
                                        width="120" height="120">
                                    <div class="d-flex align-items-center justify-content-center my-4 gap-3">
                                        <button class="btn btn-primary">Upload</button>
                                        <button class="btn btn-outline-danger">Reset</button>
                                    </div>
                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold">Change Password</h5>
                                <p class="card-subtitle mb-4">To change your password please confirm here</p>
                                <form>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Current
                                            Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            value="12345678910">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">New
                                            Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            value="12345678910">
                                    </div>
                                    <div class="">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Confirm
                                            Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            value="12345678910">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card w-100 position-relative overflow-hidden mb-0">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold">Personal Details</h5>
                                <p class="card-subtitle mb-4">To change your personal detail , edit and save from here
                                </p>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1" class="form-label fw-semibold">Your
                                                    Name</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="Mathew Anderson">
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Location</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>United Kingdom</option>
                                                    <option value="1">United States</option>
                                                    <option value="2">United Kingdom</option>
                                                    <option value="3">India</option>
                                                    <option value="3">Russia</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Email</label>
                                                <input type="email" class="form-control" id="exampleInputtext"
                                                    placeholder="info@modernize.com">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1" class="form-label fw-semibold">Store
                                                    Name</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="Maxima Studio">
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Currency</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>India (INR)</option>
                                                    <option value="1">US Dollar ($)</option>
                                                    <option value="2">United Kingdom (Pound)</option>
                                                    <option value="3">India (INR)</option>
                                                    <option value="3">Russia (Ruble)</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Phone</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="+91 12345 65478">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Address</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="814 Howard Street, 120065, India">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                                <button class="btn btn-primary">Save</button>
                                                <button class="btn btn-light-danger text-danger">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-notifications" role="tabpanel"
                aria-labelledby="pills-notifications-tab" tabindex="0">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-semibold mb-3">Notification Preferences</h4>
                                <p>
                                    Select the notificaitons ou would like to receive via email. Please note that you
                                    cannot opt out of receving service
                                    messages, such as payment, security or legal notifications.
                                </p>
                                <form class="mb-7">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Email
                                        Address*</label>
                                    <input type="text" class="form-control" id="exampleInputtext" placeholder=""
                                        required>
                                    <p class="mb-0">Required for notificaitons.</p>
                                </form>
                                <div class="">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-article text-dark d-block fs-7" width="22"
                                                    height="22"></i>
                                            </div>
                                            <div>
                                                <h5 class="fs-4 fw-semibold">Our newsletter</h5>
                                                <p class="mb-0">We'll always let you know about important changes</p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-checkbox text-dark d-block fs-7" width="22"
                                                    height="22"></i>
                                            </div>
                                            <div>
                                                <h5 class="fs-4 fw-semibold">Order Confirmation</h5>
                                                <p class="mb-0">You will be notified when customer order any product</p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22"
                                                    height="22"></i>
                                            </div>
                                            <div>
                                                <h5 class="fs-4 fw-semibold">Order Status Changed</h5>
                                                <p class="mb-0">You will be notified when customer make changes to the
                                                    order</p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-truck-delivery text-dark d-block fs-7" width="22"
                                                    height="22"></i>
                                            </div>
                                            <div>
                                                <h5 class="fs-4 fw-semibold">Order Delivered</h5>
                                                <p class="mb-0">You will be notified once the order is delivered</p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-mail text-dark d-block fs-7" width="22" height="22"></i>
                                            </div>
                                            <div>
                                                <h5 class="fs-4 fw-semibold">Email Notification</h5>
                                                <p class="mb-0">Turn on email notificaiton to get updates through email
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-semibold mb-3">Date & Time</h4>
                                <p>Time zones and calendar display settings.</p>
                                <div class="d-flex align-items-center justify-content-between mt-7">
                                    <div class="d-flex align-items-center gap-3">
                                        <div
                                            class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22"
                                                height="22"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Time zone</p>
                                            <h5 class="fs-4 fw-semibold">(UTC + 02:00) Athens, Bucharet</h5>
                                        </div>
                                    </div>
                                    <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Download">
                                        <i class="ti ti-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-semibold mb-3">Ignore Tracking</h4>
                                <div class="d-flex align-items-center justify-content-between mt-7">
                                    <div class="d-flex align-items-center gap-3">
                                        <div
                                            class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-player-pause text-dark d-block fs-7" width="22"
                                                height="22"></i>
                                        </div>
                                        <div>
                                            <h5 class="fs-4 fw-semibold">Ignore Browser Tracking</h5>
                                            <p class="mb-0">Browser Cookie</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end gap-3">
                            <button class="btn btn-primary">Save</button>
                            <button class="btn btn-light-danger text-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-semibold mb-3">Billing Information</h4>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Business Name*</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="Visitor Analytics">
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Business Address*</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="">
                                            </div>
                                            <div class="">
                                                <label for="exampleInputPassword1" class="form-label fw-semibold">First
                                                    Name*</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Business Sector*</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="Arts, Media & Entertainment">
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fw-semibold">Country*</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="Romania">
                                            </div>
                                            <div class="">
                                                <label for="exampleInputPassword1" class="form-label fw-semibold">Last
                                                    Name*</label>
                                                <input type="text" class="form-control" id="exampleInputtext"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-semibold mb-3">Current Plan : <span class="text-success">Executive</span>
                                </h4>
                                <p>Thanks for being a premium member and supporting our development.</p>
                                <div class="d-flex align-items-center justify-content-between mt-7 mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div
                                            class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-package text-dark d-block fs-7" width="22" height="22"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Current Plan</p>
                                            <h5 class="fs-4 fw-semibold">750.000 Monthly Visits</h5>
                                        </div>
                                    </div>
                                    <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Add">
                                        <i class="ti ti-circle-plus"></i>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <button class="btn btn-primary">Change Plan</button>
                                    <button class="btn btn-outline-danger">Reset Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-semibold mb-3">Payment Method</h4>
                                <p>On 26 December, 2023</p>
                                <div class="d-flex align-items-center justify-content-between mt-7">
                                    <div class="d-flex align-items-center gap-3">
                                        <div
                                            class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-credit-card text-dark d-block fs-7" width="22"
                                                height="22"></i>
                                        </div>
                                        <div>
                                            <h5 class="fs-4 fw-semibold">Visa</h5>
                                            <p class="mb-0 text-dark">*****2102</p>
                                        </div>
                                    </div>
                                    <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Edit">
                                        <i class="ti ti-pencil-minus"></i>
                                    </a>
                                </div>
                                <p class="my-2">If you updated your payment method, it will only be dislpayed here after
                                    your next billing cycle.</p>
                                <div class="d-flex align-items-center gap-3">
                                    <button class="btn btn-outline-danger">Cancel Subscription</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end gap-3">
                            <button class="btn btn-primary">Save</button>
                            <button class="btn btn-light-danger text-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab"
                tabindex="0">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-semibold mb-3">Two-factor Authentication</h4>
                                <div class="d-flex align-items-center justify-content-between pb-7">
                                    <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis
                                        sapiente sunt earum officiis laboriosam ut.</p>
                                    <button class="btn btn-primary">Enable</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                                        <p class="mb-0">Google auth app</p>
                                    </div>
                                    <button class="btn btn-light-primary text-primary">Setup</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                                        <p class="mb-0">E-mail to send verification link</p>
                                    </div>
                                    <button class="btn btn-light-primary text-primary">Setup</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
                                        <p class="mb-0">Your phone number or something</p>
                                    </div>
                                    <button class="btn btn-light-primary text-primary">Setup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-4">
                                <div
                                    class="bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                                    <i class="ti ti-device-laptop text-primary d-block fs-7" width="22" height="22"></i>
                                </div>
                                <h5 class="fs-5 fw-semibold mb-0">Devices</h5>
                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.</p>
                                <button class="btn btn-primary mb-4">Sign out from all devices</button>
                                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="ti ti-device-mobile text-dark d-block fs-7" width="26"
                                            height="26"></i>
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
                                            <p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
                                        </div>
                                    </div>
                                    <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center justify-content-between py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="ti ti-device-laptop text-dark d-block fs-7" width="26"
                                            height="26"></i>
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
                                            <p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
                                        </div>
                                    </div>
                                    <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                </div>
                                <button class="btn btn-light-primary text-primary w-100 py-1">Need Help ?</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end gap-3">
                            <button class="btn btn-primary">Save</button>
                            <button class="btn btn-light-danger text-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
          
    
@endsection


