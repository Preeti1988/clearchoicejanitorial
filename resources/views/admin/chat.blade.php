@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Chats')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/chat.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="chat-section">
            <div class="chat-userlist-sidebar">
                <div class="chat-userlist-sidebar-head">
                    <div class="chat-panel-sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M17 9C17 12.87 13.64 16 9.5 16L8.57001 17.12L8.02 17.78C7.55 18.34 6.65 18.22 6.34 17.55L5 14.6C3.18 13.32 2 11.29 2 9C2 5.13 5.36 2 9.5 2C12.52 2 15.13 3.67001 16.3 6.07001C16.75 6.96001 17 7.95 17 9Z"
                                stroke="#4F5168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M22 12.86C22 15.15 20.82 17.18 19 18.46L17.66 21.41C17.35 22.08 16.45 22.21 15.98 21.64L14.5 19.86C12.08 19.86 9.92001 18.79 8.57001 17.12L9.5 16C13.64 16 17 12.87 17 9C17 7.95 16.75 6.96001 16.3 6.07001C19.57 6.82001 22 9.57999 22 12.86Z"
                                stroke="#4F5168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7 9H12" stroke="#7BC043" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <h2>New Messages <span>08 New</span></h2>
                </div>
                <div class="chat-userlist-sidebar-body">
                    <div class="chat-userlist-filter">
                        <input type="text" name="" class="form-control" placeholder="Search by Employee Name">
                        <button class="search-btn"><i class="las la-search"></i></button>
                    </div>
                    <div class="chat-userlist-info">
                        <div class="chat-userlist-item">
                            <div class="chat-userlist-item-image">
                                <img src="images/user-default.png">
                                <span class="user-status"></span>
                            </div>
                            <div class="chat-userlist-item-content">
                                <h4>Patrick Hendricks</h4>
                                <p>hey! there I'm available</p>
                            </div>
                            <div class="chat-userlist-item-content">
                                <div class="chat-userlist-time">02:50 PM</div>
                                <div class="unread-message"><span class="badge">02</span></div>
                            </div>
                        </div>

                        <div class="chat-userlist-item">
                            <div class="chat-userlist-item-image">
                                <img src="images/user-default.png">
                                <span class="user-status"></span>
                            </div>
                            <div class="chat-userlist-item-content">
                                <h4>Patrick Hendricks</h4>
                                <p>hey! there I'm available</p>
                            </div>
                            <div class="chat-userlist-item-content">
                                <div class="chat-userlist-time">02:50 PM</div>
                                <div class="unread-message"><span class="badge">02</span></div>
                            </div>
                        </div>



                        <div class="chat-userlist-item">
                            <div class="chat-userlist-item-image">
                                <img src="images/user-default.png">
                                <span class="user-status"></span>
                            </div>
                            <div class="chat-userlist-item-content">
                                <h4>Patrick Hendricks</h4>
                                <p>hey! there I'm available</p>
                            </div>
                            <div class="chat-userlist-item-content">
                                <div class="chat-userlist-time">02:50 PM</div>
                                <div class="unread-message"><span class="badge">02</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-panel-section">
                <div class="chat-panel-chat-header">
                    <div class="chat-panel-user-item">
                        <div class="chat-panel-user-item-image"><img src="images/user-default.png"></div>
                        <div class="chat-panel-user-item-text">
                            <h4>Patrick Hendricks</h4>
                            <p>Emp Id: 210</p>
                        </div>
                    </div>

                    <div class="chat-panel-user-form">
                        <div class="chat-panel-service-dropdown">
                            <select class="form-control">
                                <option>Select Service</option>
                                <option>Select: Service 1: Testla Motors HQ</option>
                            </select>
                        </div>
                    </div>

                    <div class="chat-panel-user-action">
                        <a class="viewbtn" href="#">View Job Details</a>
                    </div>
                </div>
                <div class="chat-panel-chat-body" tabindex="1" style="overflow: auto; outline: none;">
                    <div class="chat-panel-chat-content">
                        <div class="messages-list">
                            <div class="message-item  outgoing-message">
                                <div class="message-item-chat-card">
                                    <div class="message-item-user">
                                        <img src="images/user-default.png">
                                    </div>
                                    <div class="message-item-chat-content">
                                        <div class="message-content">
                                            Did you make sure to clean the CEO's Cabin? 😃
                                        </div>
                                        <div class="time">2 Sep 2023, Sat: 12:03pm</div>
                                    </div>
                                </div>
                            </div>

                            <div class="message-item ">
                                <div class="message-item-chat-card">
                                    <div class="message-item-user">
                                        <img src="images/user-default.png">
                                    </div>
                                    <div class="message-item-chat-content">
                                        <div class="message-content">
                                            Yes Boss, I have taken care of that. I have also informed to other employees
                                        </div>
                                        <div class="time">2 Sep 2023, Sat: 12:05pm</div>
                                    </div>
                                </div>
                            </div>


                            <div class="message-item outgoing-message">
                                <div class="message-item-chat-card">
                                    <div class="message-item-user">
                                        <img src="images/user-default.png">
                                    </div>
                                    <div class="message-item-chat-content">
                                        <div class="message-content">
                                            Click on the add image option Below?
                                        </div>
                                        <div class="time">2 Sep 2023, Sat: 12:03pm</div>
                                    </div>
                                </div>
                            </div>


                            <div class="message-item">
                                <div class="message-item-chat-card">
                                    <div class="message-item-user">
                                        <img src="images/user-default.png">
                                    </div>
                                    <div class="message-item-chat-content">
                                        <div class="message-content">
                                            Okay, Understood wait let me check!!!. I have also informed to other employees
                                        </div>
                                        <div class="time">2 Sep 2023, Sat: 12:08pm</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="chat-panel-chat-footer">
                    <form>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Write a message.">
                                    <span class="form-attachemnt-icon">
                                        <img src="images/attachemnt.svg">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn-send" title="" type="button">
                                    <img src="images/direction.svg"> Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
