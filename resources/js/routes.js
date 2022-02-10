import { createRouter, createWebHistory } from "vue-router";
import Home from "./views/Home.vue";
import Signup from "./views/Signup.vue";
import Completion from "./views/Completion.vue";
import Verify from "./views/Verify.vue";
import RegisterUser from "./views/register/User.vue";
import RegisterUserConfirm from "./views/register/UserConfirm.vue";
import RegisterCard from "./views/register/Card.vue";
import RegisterCard2 from "./views/register/Card2.vue";
import RegisterCardConfirm from "./views/register/CardConfirm.vue";
import Login from "./views/Login.vue";
import PasswordEmail from "./views/password/Email.vue";
import PasswordReset from "./views/password/Reset.vue";
import MypageHome from "./views/mypage/Home.vue";
import Company from "./views/mypage/Company.vue";
import Company_edit from "./views/mypage/Company_edit.vue";
import Reps from "./views/mypage/Reps.vue";
import Reps_create from "./views/mypage/Reps_create.vue";
import Reps_edit from "./views/mypage/Reps_edit.vue";
import Client from "./views/mypage/Client.vue";
import Client_edit from "./views/mypage/Client_edit.vue";
import Plan from "./views/mypage/Plan.vue";
import Plan_edit from "./views/mypage/Plan_edit.vue";
import Premium from "./views/mypage/Premium.vue";
import Email from "./views/mypage/Email.vue";
import Password from "./views/mypage/Password.vue";
import Opinion from "./views/mypage/Opinion.vue";
import Inquiry from "./views/mypage/Inquiry.vue";
//
import SystemError from "./views/errors/System.vue";
import NotFound from "./views/errors/NotFound.vue";
import Terms from "./views/terms/Home.vue";
import Privacy from "./views/privacy/Home.vue";

const guest = (to, from, next) => {
  if (!localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/");
  }
};

const auth = (to, from, next) => {
  if (localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/login");
  }
};

const routes = [
  // トップページ
  {
    path: "/",
    component: Home,
    name: "home",
  },
  // 新規登録ページ
  {
    path: "/signup",
    component: Signup,
    name: "signup",
  },
  {
    path: "/signup/completion",
    component: Completion,
    name: "signup-completion",
    props: true,
  },
  {
    path: "/verify/:hash",
    component: Verify,
    name: "verify",
    props: true,
  },
  // 新規登録画面
  {
    path: "/register/user",
    component: RegisterUser,
    name: "register-user",
    // beforeEnter: auth,
  },
  // 新規登録内容確認画面
  {
    path: "/register/user-confirm",
    component: RegisterUserConfirm,
    name: "register-user-confirm",
    // beforeEnter: auth,
  },
  // クレジットカード登録画面
  {
    path: "/register/card",
    component: RegisterCard,
    name: "register-card",
    // beforeEnter: auth,
  },
  // クレジットカード登録画面
  {
    path: "/register/card2",
    component: RegisterCard2,
    name: "register-card2",
    // beforeEnter: auth,
  },
  // カード登録内容確認画面
  {
    path: "/register/card-confirm",
    component: RegisterCardConfirm,
    name: "register-card-confirm",
    // beforeEnter: auth,
  },
  {
    path: "/register/completion",
    component: Completion,
    name: "register-completion",
    // beforeEnter: auth,
    props: true,
  },
  // ログイン画面
  {
    path: "/login",
    component: Login,
    name: "login",
    // beforeEnter: guest,
  },
  // パスワードの再発行
  {
    path: "/password/email",
    component: PasswordEmail,
    name: "password-email",
    // beforeEnter: guest,
  },
  {
    path: "/password/request/completion",
    component: Completion,
    name: "request-completion",
    // beforeEnter: guest,
    props: true,
  },
  // パスワード設定画面
  {
    path: "/password/reset",
    component: PasswordReset,
    name: "password-reset",
    // beforeEnter: auth,
  },
  // マイページTOP
  {
    path: "/mypage",
    component: MypageHome,
    name: "mypage-home",
    // beforeEnter: auth,
  },
  // 登録情報の確認・変更
  {
    path: "/mypage/company",
    component: Company,
    name: "mypage-company",
    // beforeEnter: auth,
  },
  // 登録情報の編集
  {
    path: "/mypage/company_edit",
    component: Company_edit,
    name: "mypage-company_edit",
    // beforeEnter: auth,
  },
  // 担当者情報の登録・変更・削除
  {
    path: "/mypage/company/reps-list",
    component: Reps,
    name: "mypage-reps",
    // beforeEnter: auth,
  },
  // 担当者情報の作成
  {
    path: "/mypage/company/reps-list_create",
    component: Reps_create,
    name: "mypage-reps_create",
    // beforeEnter: auth,
  },
  // 担当者情報の編集
  {
    path: "/mypage/company/reps-list_edit",
    component: Reps_edit,
    name: "mypage-reps_edit",
    // beforeEnter: auth,
  },
  // 登録企業の担当者変更・削除
  {
    path: "/mypage/company/client/rep",
    component: Client,
    name: "mypage-client",
    // beforeEnter: auth,
  },
  // 登録企業の担当者 編集
  {
    path: "/mypage/company/client/rep_edit",
    component: Client_edit,
    name: "mypage-client_edit",
    // beforeEnter: auth,
  },
  // プラン変更 / 使用会社数の増減
  {
    path: "/mypage/company/plan",
    component: Plan,
    name: "mypage-plan",
    // beforeEnter: auth,
  },
  // プラン変更 / 使用会社数の増減 編集
  {
    path: "/mypage/company/plan_edit",
    component: Plan_edit,
    name: "mypage-plan_edit",
    // beforeEnter: auth,
  },
  // プレミアムプラン
  {
    path: "/mypage/company/premium/client-list",
    component: Premium,
    name: "mypage-premium",
    // beforeEnter: auth,
  },
  // メールアドレスの変更
  {
    path: "/mypage/company/email",
    component: Email,
    name: "mypage-email",
    // beforeEnter: auth,
  },
  // パスワードの変更
  {
    path: "/mypage/company/password",
    component: Password,
    name: "mypage-password",
    // beforeEnter: auth,
  },
  // ご意見・ご要望
  {
    path: "/mypage/opinion",
    component: Opinion,
    name: "mypage-opinion",
    // beforeEnter: auth,
  },
  // お問い合わせ
  {
    path: "/mypage/inquiry",
    component: Inquiry,
    name: "mypage-inquiry",
    // beforeEnter: auth,
  },
  // ログアウト
  {
    path: "/logout",
    component: MypageHome,
    name: "logout",
    // beforeEnter: auth,
  },
  // プライバシーポリシー
  {
    path: "/privacy",
    component: Privacy,
    name: "privacy",
    // beforeEnter: auth,
  },
  // 利用規約
  {
    path: "/terms",
    component: Terms,
    name: "terms",
    // beforeEnter: auth,
  },
  // システムエラーページ
  {
    path: "/500",
    component: SystemError,
  },
  {
    path: "/:catchAll(.*)",
    component: NotFound,
  },
];

const router = createRouter({
  routes,
  history: createWebHistory(),
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return { top: 0 };
    }
  },
});

export default router;
