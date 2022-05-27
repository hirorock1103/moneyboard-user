import { createRouter, createWebHistory } from "vue-router";
// LPページ
import Home from "./views/Home.vue";
// 新規登録ページ
import Signup from "./views/Signup.vue";
// 新規登録ページ（メール送信完了）
import Completion from "./views/Completion.vue";
// 仮登録（メール認証）
import Verify from "./views/Verify.vue";
// 新規登録画面
import RegisterUser from "./views/register/User.vue";
// 新規登録情報確認画面
import RegisterUserConfirm from "./views/register/UserConfirm.vue";
// カード新規登録
import RegisterCard from "./views/register/Card.vue";
// カード追加確認画面
import RegisterCardConfirm from "./views/register/CardConfirm.vue";
// ログイン画面
import Login from "./views/Login.vue";
// ログアウト画面
import Logoff from "./views/Logout.vue";
// パスワード再発行画面
import PasswordEmail from "./views/password/Email.vue";
// パスワード再発行（入力）画面
import PasswordReset from "./views/password/Reset.vue";
// マイページTop
import MypageHome from "./views/mypage/Home.vue";
// 登録情報の確認・変更
import Company from "./views/mypage/Company/Company.vue";
import Company_edit from "./views/mypage/Company/Company_edit.vue";
import Company_confirm from "./views/mypage/Company/Company_confirm.vue";
// カード情報の確認・変更
import Card from "./views/mypage/Card/Card.vue";
import Card_edit from "./views/mypage/Card/Card_edit.vue";
import Card_confirm from "./views/mypage/Card/Card_confirm.vue";
// 担当者
import Reps from "./views/mypage/Reps/Reps.vue";
import Reps_create from "./views/mypage/Reps/Reps_create.vue";
import Reps_confirm from "./views/mypage/Reps/Reps_confirm.vue";
import Reps_edit from "./views/mypage/Reps/Reps_edit.vue";
import Reps_edit_confirm from "./views/mypage/Reps/Reps_edit_confirm.vue";
// 登録企業
import Client from "./views/mypage/Client/Client.vue";
import Client_edit from "./views/mypage/Client/Client_edit.vue";
import Client_confirm from "./views/mypage/Client/Client_confirm.vue";
// プラン変更
import Plan from "./views/mypage/Plan/Plan.vue";
import Plan_edit from "./views/mypage/Plan/Plan_edit.vue";
// プレミアムプラン
import Premium from "./views/mypage/Premium/Premium.vue";
// メールアドレスの変更
import Email from "./views/mypage/Email/Email.vue";
import Email_confirm from "./views/mypage/Email/Email_confirm.vue";
import Email_verify from "./views/mypage/Email/Verify.vue";
import Email_complete from "./views/mypage/Email/Email_complete.vue";
// パスワードの変更
import Password from "./views/mypage/Password/Password.vue";
import Password_confirm from "./views/mypage/Password/Password_confirm.vue";
// ご意見・ご要望
import Opinion from "./views/mypage/Opinion/Opinion.vue";
import Opinion_done from "./views/mypage/Opinion/Opinion_done.vue";
// お問い合わせ
import Inquiry from "./views/mypage/Inquiry/Inquiry.vue";
import Inquiry_done from "./views/mypage/Inquiry/Inquiry_done.vue";
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
    return next("/logoff");
  }
};

const routes = [

    // ログアウト画面
    {
      path: "/logoff",
      component: Logoff,
      name: "logoff",
//      beforeEnter: auth,
    },

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
  // 新規登録ページ（メール送信完了）
  {
    path: "/signup/completion",
    component: Completion,
    name: "signup-completion",
    props: true,
  },
  // 仮登録
  {
    path: "/verify",
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

  // カード登録内容確認画面
  {
    path: "/register/card-confirm",
    component: RegisterCardConfirm,
    name: "register-card-confirm",
    // beforeEnter: auth,
  },

  // 完了画面
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
  // パスワードの再発行のメール画面
  {
    path: "/password/email",
    component: PasswordEmail,
    name: "password-email",
    // beforeEnter: guest,
  },
  // パスワード再発行画面
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
    beforeEnter: auth,
  },
  // 登録情報の確認・変更
  {
    path: "/mypage/company",
    component: Company,
    name: "mypage-company",
    beforeEnter: auth,
  },
  // 登録情報の編集
  {
    path: "/mypage/company_edit/",
    component: Company_edit,
    name: "mypage-company_edit",
    props: true,
    beforeEnter: auth,
  },
  // 登録情報の確認
  {
    path: "/mypage/company_confirm",
    component: Company_confirm,
    name: "mypage-company_confirm",
    props: true,
    beforeEnter: auth,
  },
    // カード情報の確認・変更
  {
    path: "/mypage/card",
    component: Card,
    name: "mypage-card",
    beforeEnter: auth,
  },
  // カード情報の編集
  {
    path: "/mypage/card_edit/",
    component: Card_edit,
    name: "mypage-card_edit",
    props: true,
    beforeEnter: auth,
  },
  // カード情報の確認
  {
    path: "/mypage/card_confirm",
    component: Card_confirm,
    name: "mypage-card_confirm",
    props: true,
    beforeEnter: auth,
  },
  // 担当者情報の登録・変更・削除
  {
    path: "/mypage/company/reps-list",
    component: Reps,
    name: "mypage-reps",
    beforeEnter: auth,
  },
  // 担当者情報の作成
  {
    path: "/mypage/company/reps-list_create",
    component: Reps_create,
    name: "mypage-reps_create",
    beforeEnter: auth,
    props: true
  },
  // 担当者情報の編集
  {
    path: "/mypage/company/reps-list_edit",
    component: Reps_edit,
    name: "mypage-reps_edit",
    props: true,
    beforeEnter: auth,
  },
  // 担当者情報の確認画面
  {
    path: "/mypage/company/reps-list_confirm",
    component: Reps_confirm,
    name: "mypage-reps_confirm",
    beforeEnter: auth,
    props: true
  },
  // 担当者情報の確認画面
  {
    path: "/mypage/company/reps-list_edit_confirm",
    component: Reps_edit_confirm,
    name: "mypage-reps_edit_confirm",
    beforeEnter: auth,
    props: true
  },
  // 登録企業の担当者変更・削除
  {
    path: "/mypage/company/client/rep",
    component: Client,
    name: "mypage-client",
    beforeEnter: auth,
  },
  // 登録企業の担当者 編集
  {
    path: "/mypage/company/client/rep_edit",
    component: Client_edit,
    name: "mypage-client_edit",
    beforeEnter: auth,
  },
  // 登録企業の担当者 確認画面
  {
    path: "/mypage/company/client/rep_confirm",
    component: Client_confirm,
    name: "mypage-client_confirm",
    beforeEnter: auth,
  },
  // プラン変更 / 使用会社数の増減
  {
    path: "/mypage/company/plan",
    component: Plan,
    name: "mypage-plan",
    beforeEnter: auth,
  },
  // プラン変更 / 使用会社数の増減 編集
  {
    path: "/mypage/company/plan_edit",
    component: Plan_edit,
    name: "mypage-plan_edit",
    beforeEnter: auth,
  },
  // プレミアムプラン
  {
    path: "/mypage/company/premium/client-list",
    component: Premium,
    name: "mypage-premium",
    beforeEnter: auth,
  },
  // メールアドレスの変更
  {
    path: "/mypage/company/email",
    component: Email,
    name: "mypage-email",
    beforeEnter: auth,
  },
  // メールアドレスの変更　確認
  {
    path: "/mypage/company/email_confirm",
    component: Email_confirm,
    name: "mypage-email_confirm",
    beforeEnter: auth,
  },
  // メールアドレスの変更　確認
  {
    path: "/mypage/company/email_verify",
    component: Email_verify,
    name: "mypage-email_verify",
  },
    // メールアドレスの変更　完了
  {
    path: "/mypage/company/Email_complete",
    component: Email_complete,
    name: "Email_complete",
    // beforeEnter: guest,
  },
  // パスワードの変更
  {
    path: "/mypage/company/password",
    component: Password,
    name: "mypage-password",
    beforeEnter: auth,
  },
  // パスワードの変更 確認
  {
    path: "/mypage/company/password_confirm",
    component: Password_confirm,
    name: "mypage-password_confirm",
    beforeEnter: auth,
  },
  // ご意見・ご要望
  {
    path: "/mypage/opinion",
    component: Opinion,
    name: "mypage-opinion",
    beforeEnter: auth,
  },
  {
    path: "/mypage/opinion_done",
    component: Opinion_done,
    name: "mypage-opinion_done",
    beforeEnter: auth,
  },
  // お問い合わせ
  {
    path: "/mypage/inquiry",
    component: Inquiry,
    name: "mypage-inquiry",
    beforeEnter: auth,
  },
  {
    path: "/mypage/inquiry_done",
    component: Inquiry_done,
    name: "mypage-inquiry_done",
    beforeEnter: auth,
  },
  // ログアウト
  {
    path: "/logout",
    component: MypageHome,
    name: "logout",
    beforeEnter: auth,
  },
  // プライバシーポリシー
  {
    path: "/privacy",
    component: Privacy,
    name: "privacy",
    beforeEnter: auth,
  },
  // 利用規約
  {
    path: "/terms",
    component: Terms,
    name: "terms",
    beforeEnter: auth,
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
