<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<form v-on:submit.prevent="messageSend">
							<div class="form-group row justify-content-center no-gutters">
								<div class="col-md-11 border rounded g-0" id="conversationBox">
<!-- 									<message-recieved></message-recieved>
									<message-sent></message-sent>
									<message-sending></message-sending> -->
									<div
										v-bind:is="message.type"
										v-for="message in messages"
										v-bind:key="message.id"
										v-bind:content="message.content"
										v-on:remove="todos.splice(index,1)"
										@hook:mounted="scrollToBottom()"
									></div>
									
									
								</div>
							</div>
							<div class="form-group row justify-content-center">
								<input 
									class="form-control col-md-9" 
									type="text" 
									v-model="newMessageText"
									id="userInput"
								>
								<button class="btn btn-primary mb-2 col-md-2">Send</button>
							</div>
							
						</form>
					</div>
				</div>
			</div>	
		</div>
	</div>
</template>

<script>

    // Default Vue scripts
	export default {
		props: {
			posturl: String,
			channel: String
		},
		data() {
			return {
				newMessageText: '',
				messages: [
				],
				nextMessageId: 1
			}
		},
		mounted() {
		},
		methods: {
			scrollToBottom: function () {
				var container = document.getElementById('conversationBox');
				container.scrollTop = container.scrollHeight;	
			},
			messageReceived: function (message) {
				this.messages.push({
					id: this.nextMessageId++,
					content: message,
					type: 'message-received'
				})
				console.log(this.messages)
			},
			messageSent: function () {
				this.messages.push({
					id: this.nextMessageId++,
					content: this.newMessageText,
					type: 'message-sent'
				})
				this.newMessageText = ''
			},
			messageSend: function () {
				var input = document.getElementById('userInput');
				this.messageSent()

				axios
					.post(this.posturl,{
						message: input.value
					})
					.then(function (response) {
						console.log(response);
					})
					.catch(function (error) {
						console.log('message error: ' + error);
					})
			}
		},
		created() {
			Echo.private(this.channel)
			.listen(".MessageUser", (e) => {
				console.log('receiving a message');
				this.messageReceived(e.message);
				console.log(e.message);
			});
		}
		
	}

</script>

<style lang="scss">

#conversationBox {
	height: 25vh;
	overflow-y: scroll;
	.received div{
		background-color: lightblue;
	}
	.sending, .sent, .received {
		margin-top: 2px;
		margin-bottom: 2px;
	}
	.sending, .sent {
		margin-right: 0px;
	}
	.sending div{
		background-color: lightgray;
	}
	.sent div{
		background-color: lightgreen;
	}
}

</style>