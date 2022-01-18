/**
 * 小文字のバリデーションルール
 */
export default string => {

    if(false === /[a-z]/.test(string))
        return false;

    return true;
};
