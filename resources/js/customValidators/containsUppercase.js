/**
 * 大文字のバリデーションルール
 */
export default string => {

    if(false === /[A-Z]/.test(string))
        return false;

    return true;
};
