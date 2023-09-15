/**
 * 文字とスペースはバリデーションルール
 */
export default string => {

    if (typeof string === "undefined" || string.length === 0) { // 空文字は required に任せるのでスルー
        return true;
    }

    if(false === /[A-Z]([-']?[A-Z]+)*( [A-Z]([-']?[A-Z]+)*)+$/.test(string))
        return false;

    return true;
};
