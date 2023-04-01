@extends('admin.master') @section('content') @include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
	@include('admin.include.sidebar')
	<div id="content" class="p-4">
		<h1 class="font-30 color-f58719 mb-4">Messages</h1>
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="chat-users">
					<div class="chat-profile">
						<ul>
							<li>
								<div class="user-chat-img">
									<img
										src="{{ URL::to(get_user()->image_url)  }}"
										alt="user-profile"
									/>
								</div>
							</li>
							<li class="user-name">
								<h2 class="font-30 color-black">
									{{ get_user()->name }}
									<img
										src="{{ asset('assets/images/online-icon.png') }}"
										alt="user-profile"
										class="ml-4"
									/>
								</h2>
								<p>{{ get_user()->email }}</p>
							</li>
						</ul>
					</div>
					<div class="input-group mb-3 territories-input">
						<input
							type="text"
							name="search"
							class="form-control autocomplete"
							placeholder="Find people and conversations"
						/>
						<div class="search-icon">
							<span>
								<i class="fa fa-search"></i>
							</span>
						</div>
					</div>
					<div class="tabs-area">
						<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
								<a
									class="nav-link active"
									id="pills-recent-tab"
									data-toggle="pill"
									href="#pills-recent"
									role="tab"
									aria-controls="pills-recent"
									aria-selected="true"
									>Recent</a
								>
							</li>
							<li class="nav-item" role="presentation">
								<a
									class="nav-link"
									id="pills-groups-tab"
									data-toggle="pill"
									href="#pills-groups"
									role="tab"
									aria-controls="pills-groups"
									aria-selected="false"
									>Group
								</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div
								class="tab-pane fade show active"
								id="pills-recent"
								role="tabpanel"
								aria-labelledby="pills-recent-tab"
							>
								<div id="recent_chat" class="chat mt-5"></div>
							</div>
							<div
								class="tab-pane fade"
								id="pills-groups"
								role="tabpanel"
								aria-labelledby="pills-groups-tab"
							>
								<div id="recent_group"></div>
								<a data-toggle="modal" id="tooltip" data-placement="top" title="Create Chat Group" data-target="#addGroup" href="javascript:void(0)">
									<img
										src="{{ asset('assets/images/add-user.png') }}"
										alt="user-profile"
										class="ad-user"
									/>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-8">
				<div class="chat-screen">
					<div class="chat-detail chat-bottom-border d-flex align-items-center">
						<div class="active-chat-user" id="active_chat_user_name"></div>
						<div id="chat_room_title" style="margin-top: 10px;" class="other-user-names ml-3 chat-time">
							<p class="font-18">Chat Room</p>
						</div>
					</div>
					<div class="chatting-area">
						<div class="chat-box"></div>
					</div>
				</div>
				<div class="msg-input">
					<div class="postion-relative">
						<input type="text" class="chat_message" name="chat_message" placeholder="Write here…" />
						<div class="send-icon">
							<img
								class="send_message"
								src="{{ asset('assets/images/send.png') }}"
								alt="Send Message"
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="row">
			<div class="col-md-4 mb-3">
				<div class="inbox">
					<div class="media mb-3">
						<img
							src="{{ URL::to(get_user()->image_url)  }}"
							class="mr-3 active-user"
							alt="{{ get_user()->name }}"
						/>
						<div class="media-body">
							<h5 class="mb-1 active-username">{{ get_user()->name }}</h5>
							<p class="ft-14">{{ get_user()->email }}</p>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"
								><i class="fa fa-search" aria-hidden="true"></i
							></span>
						</div>
						<input
							type="search"
							name="search"
							class="form-control autocomplete"
							placeholder="Find people and conversation"
							autocomplete="off"
						/>
					</div>
					<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<a
								class="nav-link active"
								id="pills-recent-tab"
								data-toggle="pill"
								href="#pills-recent"
								role="tab"
								aria-controls="pills-recent"
								aria-selected="true"
								>Recent Chat</a
							>
						</li>
						<li class="nav-item" role="presentation">
							<a
								class="nav-link"
								id="pills-groups-tab"
								data-toggle="pill"
								href="#pills-groups"
								role="tab"
								aria-controls="pills-groups"
								aria-selected="false"
								>Group
								<i
									data-toggle="modal"
									id="tooltip"
									data-toggle="tooltip"
									data-placement="top"
									title="Add Group"
									data-target="#addGroup"
									class="fa fa-plus-circle pl-1"
								></i
							></a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div
							class="tab-pane fade show active"
							id="pills-recent"
							role="tabpanel"
							aria-labelledby="pills-recent-tab"
						>
							<div id="recent_chat"></div>
						</div>
						<div
							class="tab-pane fade"
							id="pills-unread"
							role="tabpanel"
							aria-labelledby="pills-unread-tab"
						>
							...
						</div>
						<div
							class="tab-pane fade"
							id="pills-groups"
							role="tabpanel"
							aria-labelledby="pills-groups-tab"
						>
							<div id="recent_group"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 mb-3">
				<div class="chats">
					<div class="active-chat-user" id="active_chat_user_name">
						Chat Room
						<hr />
					</div>
					<div data-receiver="0" class="chat-box"></div>
					<div id="start_typing" class="row send-message"></div>
					<div class="message-box">
						<div class="input-group mb-3">
							<textarea
								maxlength="1000"
								max="1000"
								class="form-control chat_message"
								name="chat_message"
								placeholder="Message here"
								style="border: none; resize: none"
							></textarea>
							<input
								type="file"
								name="attachment"
								id="attachment"
								accept="image/*"
								style="display: none"
							/>
							<div class="input-group-append selectAttachment">
								<span class="input-group-text" style="border: none">
									<i class="fa fa-paperclip" aria-hidden="true"></i>
								</span>
							</div>
							<div class="input-group-append send_message">
								<span class="input-group-text" style="border: none"
									><i class="fa fa-paper-plane" aria-hidden="true"></i
								></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
	</div>
</div>
@include('admin.modal.add-group',['users' => $users]) @push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="{{ asset('assets/admin/js/chat.js') }}"></script>
<script>
	$('#tooltip').tooltip()
</script>
@endpush @endsection
