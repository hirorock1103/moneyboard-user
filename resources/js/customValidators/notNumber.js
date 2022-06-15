/**
 * 数字のバリデーションルール
 */
export default string => {

    if(false === /\d/.test(string))
        return false;

    return true;
};
