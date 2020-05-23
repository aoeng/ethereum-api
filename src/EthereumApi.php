<?php


namespace Aoeng\EthereumApi;


use Illuminate\Support\Facades\Http;

class EthereumApi
{
    private $address;

    private $host;

    private $key;

    private $url;

    public function __construct()
    {
        $this->host = config('ethereum.host');
        $this->key = config('ethereum.key');
    }

    public function address($address)
    {
        $this->address = $address;
    }


    /**
     * 获取以太币余额
     * @param $address
     * @return bool|mixed
     */
    public function accountBalance($address)
    {
        $this->url = "{$this->host}?module=account&action=balance&apikey={$this->key}&address={$address}&tag=latest";

        return $this->request();
    }

    /**
     * 获取以太币余额(多个地址)
     * @param $address
     * @return bool|mixed
     */
    public function accountBalanceMulti($address)
    {
        $this->url = "{$this->host}?module=account&action=balancemulti&apikey={$this->key}&address={$address}&tag=latest";
        return $this->request();
    }

    /**
     * 获取交易列表(正常)
     * @param $address
     * @return bool|mixed
     */
    public function accountTxList($address)
    {
        $this->url = "{$this->host}?module=account&action=txlist&apikey={$this->key}&address={$address}&startblock=0&endblock=99999999&page=1&offset=10&sort=asc";
        return $this->request();
    }

    /**
     * 获取交易列表(内部)
     * @param $address
     * @return bool|mixed
     */
    public function accountTxListInternal($address)
    {
        $this->url = "{$this->host}?module=account&action=txlistinternal&apikey={$this->key}&address={$address}&startblock=0&endblock=99999999&page=1&offset=10&sort=asc";
        return $this->request();
    }

    /**
     * 获取“ ERC20-令牌转移事件”的列表获取交易列表
     * @param $address
     * @return bool|mixed
     */
    public function accountTokenTx($address)
    {
        $this->url = "{$this->host}?module=account&action=tokentx&apikey={$this->key}&address={$address}&startblock=0&endblock=99999999&page=1&offset=10&sort=asc";
        return $this->request();
    }

    /**
     * 获取“ ERC721-令牌转移事件”的列表获取交易列表
     * @param $address
     * @return bool|mixed
     */
    public function accountTokenNftTx($address)
    {
        $this->url = "{$this->host}?module=account&action=tokennfttx&apikey={$this->key}&address={$address}&startblock=0&endblock=99999999&page=1&offset=10&sort=asc";
        return $this->request();
    }

    /**
     * 获取按地址挖掘的区块列表
     * @param $address
     * @return bool|mixed
     */
    public function accountGetMinedBlocks($address)
    {
        $this->url = "{$this->host}?module=account&action=getminedblocks&apikey={$this->key}&address={$address}&startblock=0&endblock=99999999&page=1&offset=10&sort=asc&blocktype=blocks";
        return $this->request();
    }

    /**
     * 通过ContractAddress获取ERC20代币总供应量
     * @param $address
     * @return bool|mixed
     */
    public function statsTokenSupply($address)
    {
        $this->url = "{$this->host}?module=stats&action=tokensupply&apikey={$this->key}&contractaddress={$address}";
        return $this->request();
    }

    /**
     * 获取TokenContractAddress的ERC20令牌帐户余额
     * @param $contractAddress
     * @param $address
     * @return bool|mixed
     */
    public function accountTokenBalance($contractAddress, $address)
    {
        $this->url = "{$this->host}?module=account&action=tokenbalance&apikey={$this->key}&contractaddress={$contractAddress}&address={$address}&tag=latest";
        return $this->request();
    }


    protected function request()
    {
        try {
            $response = Http::get($this->url);
            return json_decode($response->body(), true);
        } catch (\Exception $exception) {
            return false;
        }
    }
}
