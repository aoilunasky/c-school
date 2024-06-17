<template>
  <div class="border">
    <div class="row">
      <div class="col-12">
        <div class="chat-box" v-chat-scroll>
          <div
            v-if="loading"
            class="d-flex align-items-center justify-content-center h-100"
          >
            <div class="lds-dual-ring"></div>
          </div>
          <div v-else>
            <div class="list-group" v-if="chats.length > 0">
              <div
                class="list-group-item chat-item"
                v-for="chat in chats"
                :key="chat.key"
              >
                <div
                  class="chat-message text-right"
                  v-if="chat.user === nickname"
                >
                  <div class="right-bubble">
                    <span class="msg-date">{{ chat.sendDate }}</span>
                    <span class="msg-name">Me</span>
                    <p text-wrap>{{ chat.message }}</p>
                  </div>
                </div>
                <div
                  class="chat-message text-left"
                  text-left
                  v-if="chat.user !== nickname"
                >
                  <div class="left-bubble">
                    <span class="msg-name">{{ chat.user }}</span>
                    <span class="msg-date">&nbsp;{{ chat.sendDate }}</span>
                    <p text-wrap>{{ chat.message }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-end chat-box justify-content-center" v-else>
              <span class="bg-dark mb-2 p-2 text-white rounded" v-if="isadmin">
                Start Texting with {{email}}
              </span>
               <span class="bg-dark mb-2 p-2 text-white rounded" v-else>
                Start Texting with Admin
              </span>
            </div>
          </div>
        </div>
        <div class="footer">
          <form @submit="onSubmit">
            <div class="input-group">
              <input
                class="form-control"
                id="input2-group2"
                type="text"
                name="input2-group2"
                v-model.trim="data.message"
                placeholder="Messages...."
                autocomplete="off"
              />
              <span class="input-group-append">
                <button
                  class="btn btn-primary"
                  type="submit"
                  :disabled="!data.message"
                >
                  <i class="cil-send"></i>
                </button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.footer {
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 10px;
  background-color: #ffffff;
  border-top: solid 1px #efefef;
}
.chat-box {
  height: 500px;
  width: 100%;
  overflow: scroll;
}
.chat-item {
  border: none;
}
.chat-status {
  min-height: 49px;
}
.chat-status .chat-date {
  display: block;
  font-size: 10px;
  font-style: italic;
  color: #999;
  height: 15px;
  left: 10%;
  right: 10%;
}
.chat-status .chat-content-center {
  padding: 5px 10px;
  background-color: #e1e1f7;
  border-radius: 6px;
  font-size: 12px;
  color: #555;
  height: 34px;
  left: 10%;
  right: 10%;
}
.chat-message {
  width: 80%;
  min-height: 40px;
}
.chat-message .right-bubble {
  position: relative;
  background: #dcf8c6;
  border-top-left-radius: 0.4em;
  border-bottom-left-radius: 0.4em;
  border-bottom-right-radius: 0.4em;
  padding: 5px 10px 10px;
  left: 15%;
}
.chat-message .right-bubble span.msg-name {
  font-size: 12px;
  font-weight: bold;
  color: green;
}
.chat-message .right-bubble span.msg-date {
  font-size: 10px;
}
.chat-message .right-bubble:after {
  content: "";
  position: absolute;
  right: 0;
  top: 0;
  width: 0;
  height: 0;
  border: 27px solid transparent;
  border-left-color: #dcf8c6;
  border-right: 0;
  border-top: 0;
  margin-top: -0.5px;
  margin-right: -27px;
}
.chat-message .left-bubble {
  position: relative;
  background: #efefef;
  border-top-right-radius: 0.4em;
  border-bottom-left-radius: 0.4em;
  border-bottom-right-radius: 0.4em;
  padding: 5px 10px 10px;
  left: 5%;
}
.chat-message .left-bubble span.msg-name {
  font-size: 12px;
  font-weight: bold;
  color: blue;
}
.chat-message .left-bubble span.msg-date {
  font-size: 10px;
}
.chat-message .left-bubble:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  width: 0;
  height: 0;
  border: 27px solid transparent;
  border-right-color: #efefef;
  border-left: 0;
  border-top: 0;
  margin-top: -0.5px;
  margin-left: -27px;
}
.border {
  border: solid 2px #efefef;
}
.lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid #3c4c64;
  border-color: #3c4c64 transparent #3c4c64 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>

<script>
import firebase from "../firebase";
//
export default {
  props: ["user", "email" , "isadmin", 'notifyid'],
  data() {
    return {
      nickname: this.$props.user.f_name + " " + this.$props.user.l_name,
      data: { type: "", nickname: "", message: "" },
      chats: [],
      loading: true,
      offStatus: false,
    };
  },
  created() {
    this.loadData(this.email);
  },
  watch: {
    email: function (newVal, oldVal) {
      this.loading = true;
      this.loadData(newVal);
    },
  },
  methods: {
    loadData(key) {
      this.data.message = "";
      this.chats = [];
      firebase
        .firestore()
        .collection("chatrooms")
        .doc(key)
        .collection("chats")
        .orderBy("timestamp", "asc")
        .onSnapshot((snapshot) => {
          snapshot.docChanges().forEach((change) => {
            let item = change.doc.data();
            item.key = change.doc.id;
            if(!this.chats.some(e=> e.key==item.key)){
              this.chats.push(item);
            }
          });
           this.loading = false;
        });
    },
    onSubmit(evt) {
      evt.preventDefault();
      firebase
        .firestore()
        .collection("chatrooms")
        .doc(this.email)
        .collection("chats")
        .add({
          type: "newmsg",
          user: this.nickname,
          message: this.data.message,
          sendDate: Date(),
          timestamp: new Date().getTime()
        });
      this.data.message = "";
      axios.post('/chat/sendnoti',{
        userID: this.notifyid
      })
        .catch(error => console.log(error))
        .then(() => { this.loading = false })
    },
  },
};
</script>