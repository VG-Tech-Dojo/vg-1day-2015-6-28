## <a name="overview"></a> 概要

### リクエスト共通仕様

* 有効な Content-Type は application/json のみです
* リクエストボディは空か、 [RFC 7159](https://tools.ietf.org/html/rfc7159) にて定義された JSON として正しい文字列でなければなりません
    * たとえば、文字エンコーディングは常に UTF-8 である必要があります

### レスポンス共通仕様

* 特記のない限り、レスポンスの Content-Type は application/json となります
* 正常系 (HTTP ステータスコード 2xx) のレスポンスではリソースのオブジェクト自体を JSON シリアライズした文字列か、リソースのオブジェクトを各要素に有する配列を JSON シリアライズした文字列を返します
* 異常系 (HTTP ステータスコード 4xx もしくは 5xx) のレスポンスでは、エラーの内容を表すオブジェクトを JSON シリアライズした文字列を返します
