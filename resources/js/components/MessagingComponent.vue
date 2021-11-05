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
										is="message-sent"
										v-for="message in messages"
										v-bind:key="message.id"
										v-bind:content="message.content"
										v-on:remove="todos.splice(index,1)"
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
			posturl: String
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
			messageSent: function () {
				this.messages.push({
					id: this.nextMessageId++,
					content: this.newMessageText
				})
				this.newMessageText = ''
			},
			messageSend: function () {
				var input = document.getElementById('userInput');
				var self = this;

				axios
					.post(this.posturl,{
						message: input.value
					})
					.then(function (response) {
						console.log(response);
						self.messageSent()
					})
					.catch(function (error) {
						console.log('message error: ' + error);
					})
			}
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
	.sending, .sent {
		margin-right: 0px;
		margin-top: 2px;
	}
	.sending div{
		background-color: lightgray;
	}
	.sent div{
		background-color: lightgreen;
	}
}

</style>