/**
 * 文字とスペースはバリデーションルール
 */
export default string => {

    if(false === /[A-Z]([-']?[A-Z]+)*( [A-Z]([-']?[A-Z]+)*)+$/.test(string))
        return false;

    return true;
};
