<template>
  <div class="row">
    <div class="col-md-5 overflow-auto" style="height: 550px">
      <ul class="list-group">
        <li
          class="
            list-group-item
            d-flex
            list-group-item-action
            justify-content-between
            align-items-center
          "
          v-for="teacher in teachers"
          :key="teacher.id"
          @click="chat=teacher.email;notifyId=teacher.id"
          :class="{ active: chat==teacher.email}"
        >
          {{ teacher.f_name }} {{ teacher.l_name }}
        </li>
      </ul>
    </div>
    <div class="col-md-7">
      <chat-message-form-component
        v-if="chat"
        :email="chat"
        :user="this.user"
        :notifyid="this.notifyId"
        :isadmin="true"
      ></chat-message-form-component>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user", "teachers"],
  data: () => ({
    chat: "",
    notifyId:''
  }),
};
</script>